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
use Illuminate\Support\Facades\DB;
use App\Repository\Cours_fee\CoursfeeInterface;
use App\Repository\Cours\CoursInterface;
use App\Repository\Fee_Type\Fee_TypeInterface;

class CoursController extends Controller
{

    protected $cours;
    protected $feetype;
    protected $coursfee;

    /**
     * CoursController constructor.
     * @param $cours
     */
    public function __construct(
        CoursInterface $cours,
        Fee_TypeInterface $feetype,
        CoursFeeInterface $coursfee
    ) {
        $this->cours = $cours;
        $this->feetype = $feetype;
        $this->coursfee = $coursfee;
    }


    public function index()
    {
        $cours = $this->cours->all_cours();
        return view('admin.cours.index', compact('cours'));
    }

    public function create()
    {
        $fee_type = $this->feetype->get_all();
        $teacher = Admin::role('teacher')->get();
        $grade = Grade::select()->get();
        $level = level::select()->get();
        $status_od_cours = Statusofcour::select()->get();
        $cours_currency = Currency::active()->get();
        return view('admin.cours.create', compact('grade', 'level', 'status_od_cours', 'teacher', 'fee_type', 'cours_currency'));
    }

    public function store(InsertCoursRequest $request)
    {
        // return $request ;
        try {
            DB::beginTransaction();
            // return $id = getId(Admin::class, 'name',$request->teacher_name);
            $teacher_id = Admin::GetIdByName($request->teacher_name);
            $id_cours = $this->cours->store_cours($request, $teacher_id);
            $cours_fee = $this->coursfee->create($request->fee, $id_cours, $request->cours_currency);
            DB::commit();
            if (!$id_cours || !$cours_fee) {
                toastr()->error(__('site.please add data in the field'));
                return redirect()->route('admin.cours.add');
            } else {

                toastr()->success(__('site.Post created successfully!'));
                return redirect()->route('admin.cours.add');
            }
        } catch (\Throwable $th) {
            DB::rollback();
            // throw $th;
            return $th;
        }
    }


    public function edit(Request $request,$id)
    {
return Cours::find($id);

        try {
            //  Cours::select_wht()->get();//->where('id','=',$id)->get();
        return   $cours =  $this->cours->is_defined($id);
        //  return  $cours = $this->cours->all_cours();
        //    $teacher = Admin::find($cours->id);
        //    $level = level::find($cours->id);
           $fee_defined =$this->coursfee->is_fee_defined($id);


           //   return    $cours = CoursFee::where('cours_id','=', $cours->id)->get();
            if (!$cours) {
                toastr()->error(__('site.cours note defined'));
                return redirect()->route('admin.cours.all');
            } else {
                // return view('admin.cours.edit',compact()) ;
            }
        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }


        // if($this->cours->edit_cours($id))
    }
}
