<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InsertCoursRequest;
use App\Models\Admin;
use App\Models\Currency;
use App\Models\Grade;
use App\Models\level;
use App\Models\CoursFee;
use App\Models\cours;
use Illuminate\Http\Request;
use App\Models\Statusofcour;
use App\Repository\Admin\AdminInterface;
use Illuminate\Support\Facades\DB;
use App\Repository\Cours_fee\CoursfeeInterface;
use App\Repository\Cours\CoursInterface;
use App\Repository\Fee_Type\Fee_TypeInterface;

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
        $level = level::select()->get();
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
        // return $request;
        try {
            DB::beginTransaction();
            // $teacher_id = Admin::GetIdByName($request->teacher_name);
            $teacher_id  = $this->teacher->GetTeacherIDbyName($request->teacher_name);

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
        $cours =  $this->cours->is_defined($id);
        try {
            if (!$cours) {
                toastr()->error(__('site.cours note defined'));
                return redirect()->route('admin.cours.all');
            } else {
                $coursfee_max = $this->coursfee->is_fee_defined($id)->max('fee_types_id');
                $level_cours =  $cours->level;
                $grade_cours =  $cours->grade;
                $teacher = Admin::role('teacher')->get(['id', 'name']);
                $status_od_cours = Statusofcour::select()->get();
                $grade = Grade::select()->get();
                $level = level::select()->get();
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
                    'fee_type_id',
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
            //code...
            $teacher_id  = $this->teacher->GetTeacherIDbyName($request->teacher_name);
            $this->cours->update_cours($request, $teacher_id, $id);
            $cours_fee = $this->coursfee->update_fee_cours($request->fee, $id, $request->cours_currency);
            toastr()->success(__('site.Post created successfully!'));
            return redirect()->route('admin.cours.all');
        } catch (\Throwable $th) {
            throw $th;
        }

        // return $request;
    }

    /****
     * end of Class
     */
}
