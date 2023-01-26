<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Grade;
use App\Models\Level;
use App\Models\Currency;
use App\Models\Statusofcour;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repository\Admin\AdminInterface;
use App\Repository\Cours\CoursInterface;
use App\Http\Requests\InsertCoursRequest;
use App\Models\CoursFee;
use App\Repository\Fee_Type\Fee_TypeInterface;
use App\Repository\Cours_fee\CoursFeeInterface;
use Illuminate\Http\Request;

class CoursController extends Controller
{

    protected $cours;
    protected $feetype;
    protected $coursfee;
    protected $teacher;

    /**
     * CoursController constructor.
     * @param $cours
     */
    public function __construct(
        CoursInterface $cours,
        Fee_TypeInterface $feetype,
        CoursFeeInterface $coursfee,
        AdminInterface $teacher
    ) {
        $this->cours = $cours;
        $this->feetype = $feetype;
        $this->coursfee = $coursfee;
        $this->teacher = $teacher;
    }


    public function index()
    {
        $cours = $this->cours->all_cours();
        return view('admin.cours.index', compact('cours'));
    }

    public function create()
    {
        $fee_type = $this->feetype->get_all();
        $fee_type_id = $this->feetype->fee_type_id();
        $teacher = Admin::role('teacher')->get();
        $grade = Grade::select()->get();
        $level = Level::select()->get();
        $status_od_cours = Statusofcour::select()->get();
        $cours_currency = Currency::active()->get();
        // $id_fee_type = $fee_type->id;
        return view('admin.cours.create', compact(
            'grade',
            'level',
            'status_od_cours',
            'teacher',
            'fee_type',
            'cours_currency',
            'fee_type_id'
        ));
    }

    public function store(InsertCoursRequest $request)
    {
        //  return $request;
        try {
            DB::beginTransaction();
            $teacher_id = Admin::GetIdByName($request->teacher_name);
            // $teacher_id  = $this->teacher->GetTeacherIDbyName($request->teacher_name);

            $id_cours = $this->cours->store_cours($request, $teacher_id);

            if ($request->has('fee')) {
                $cours_fee = $this->coursfee->create($request->fee, $id_cours, $request->cours_currency);
            }

            DB::commit();
            if (!$id_cours) {
                toastr()->error(__('site.please add data in the field'));
                return redirect()->route('admin.cours.add');
            } else {
                toastr()->success(__('site.Post created successfully!'));
                return redirect()->route('admin.cours.all');
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
            toastr()->error(__('site.you have error'));
            return redirect()->back();
        }
    }


    public function edit($id)
    {
        $cours = $this->cours->is_defined($id);

        try {
            if (!$cours) {
                toastr()->error(__('site.cours note defined'));
                return redirect()->route('admin.cours.all');
            } else {
                $coursfee_max = $this->coursfee->is_fee_defined($id)->max('fee_types_id');
                $level_cours = $cours->level;
                $grade_cours = $cours->grade;
                $teacher = Admin::role('teacher')->get(['id', 'name']);
                $status_od_cours = Statusofcour::select()->get();
                $grade = Grade::select()->get();
                $level = Level::select()->get();
                $cours_currency = Currency::active()->get();
                $coursfee = $this->coursfee->is_fee_defined($id);
                $fee_type = $this->feetype->get_all();
                $fee_type_id = $this->feetype->fee_type_id();
                return view('admin.cours.edit', compact(
                    'cours',
                    'level',
                    'grade',
                    'teacher',
                    'coursfee',
                    'level_cours',
                    'grade_cours',
                    'status_od_cours',
                    'cours_currency',
                    'fee_type',
                    'coursfee_max',
                    'fee_type_id'
                ));
            }
        } catch (\Throwable $th) {
            //throw $th;
            toastr()->error(__('site.you have error'));
            return redirect()->back();
        }


        // if($this->cours->edit_cours($id))
    }


    public function update(InsertCoursRequest $request, $id)
    {

        try {
            //   return $request;
            //code...
            // $teacher_id  = $this->teacher->GetTeacherIDbyName($request->teacher_name);
            $teacher_id = Admin::GetIdByName($request->teacher_name);
            $this->cours->update_cours($request, $teacher_id, $id);
            // return $request->has('fee');
            if ($request->has('fee')) {
                $cours_fee = $this->coursfee->update_fee_cours($request->fee, $id, $request->cours_currency);
            } else {
                if ($this->cours->count_students_in_cours($id) == 0) {
                    $cours_fee = $this->coursfee->update_fee_cours(0, $id, $request->cours_currency);
                }
                toastr()->error(__('site.you can\'t edit this cours because it have students'));
                return redirect()->route('admin.cours.all');
            }

            toastr()->success(__('site.Post created successfully!'));
            return redirect()->route('admin.cours.all');
        } catch (\Throwable $th) {
            // throw $th;
            toastr()->error(__('site.you site.you have error'));
            return redirect()->route('admin.cours.all');
        }

        // return $request;
    }

    public function delete(Request $request)
    {

        $cours = $this->cours->is_defined($request->id);
        $count_std =   $this->cours->count_students_in_cours($request->id);
        $message ='';
        $status = '';
        $route = "#";
        try {
            DB::beginTransaction();
            if ($cours == false || $count_std > 0) {
                $message = __('site.you can\'t delete this cours it have students or not defined');
                $status = 'error';
                $route = "#";
                
                return response()->json(['message' => $message, 'status' => $status, 'route' => $route]);
            }
             $is_cours_fee_deleted = $this->coursfee->delete_fee_cours($request->id);
        //    return response()->json($is_cours_fee_deleted);
           
           if ($is_cours_fee_deleted) {
                $is_cours_deleted =  $cours->delete();
                if ($is_cours_deleted) {
                    $message = __('site.cours delete successfully');
                    $status = 'success';
                    $route = "#";
                } else {
                    $message = __('site.cours not deleted');
                    $status = 'success';
                    $route = "#";
                }
            }
            DB::commit();
            return response()->json(['message' => $message, 'status' => $status, 'route' => $route]);
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
             $message = __('site.you have error');
                     $status = 'success';
                     $route = "#";
             return response()->json(['message' => $message, 'status' => $status, 'route' => $route]);
        }


        // return $request;
        // if()
    }
    /****
     * end of Class
     */
}
