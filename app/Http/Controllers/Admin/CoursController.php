<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InsertCoursRequest;
use App\Models\Admin;
use App\Models\Cours;
use App\Models\Currency;
use App\Models\fee_type;
use App\Models\Grade;
use App\Models\level;
use App\Repository\Cours\CoursInterface;
use App\Repository\Fee_Type\Fee_TypeInterface;
use Illuminate\Http\Request;
use App\Models\Statusofcour;
use Illuminate\Database\Events\TransactionRolledBack;
use Illuminate\Support\Facades\DB;
use App\Repository\Cours\CoursRepositoryInterface;

class CoursController extends Controller
{

    protected $cours;
    protected $feetype;

    /**
     * CoursController constructor.
     * @param $cours
     */
    public function __construct(CoursInterface $cours, Fee_TypeInterface $feetype)
    {
        $this->cours = $cours;
        $this->feetype = $feetype;
    }


    public function index()
    {
        $cours = $this->cours->all_cours();
        return view('admin.cours.index', compact('cours'));
    }

    public function create()
    {
        $teacher = Admin::role('teacher')->get();
        $grade = Grade::select()->get();
        $level = level::select()->get();
        $fee_type = $this->feetype->get_all();
        $status_od_cours = Statusofcour::select()->get();
        $cours_currency = Currency::active()->get();
        return view('admin.cours.create', compact('grade', 'level', 'status_od_cours', 'teacher', 'fee_type','cours_currency'));
    }

    public function store(InsertCoursRequest $request)
    {
        return $request;
        try {
            DB::beginTransaction();

            $id_cours = $this->cours->store_cours($request);

            DB::commit();


            if (!$id_cours) {
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
}
