<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InsertCoursRequest;
use App\Models\Admin;
use App\Models\Cours;
use App\Models\Grade;
use App\Models\level;
use Illuminate\Http\Request;
use App\Models\Statusofcour;
use Illuminate\Database\Events\TransactionRolledBack;
use Illuminate\Support\Facades\DB;

class CoursController extends Controller
{
    public function index()
    {

        return view('admin.cours.index');
    }

    public function create()
    {
        $teacher = Admin::role('teacher')->get();
        // return $teacher;
        $grade = Grade::select()->get();
        $level = level::select()->get();
        $status_od_cours = Statusofcour::select()->get();
        return view('admin.cours.create', compact('grade', 'level', 'status_od_cours', 'teacher'));
    }

    public function store(InsertCoursRequest $request)
    {
        // return $request;
        try {
            DB::beginTransaction();

            $saved = Cours::create([
                'startDate' => $request->start_date,
                'endDate' => $request->end_date,
                'maxStd' => $request->max_std_number,
                'status' => $request->status,
                'teachername' => $request->teacher_name,
                'teacherFee' => $request->teacher_fee,
                'startTime' => $request->start_time,
                'endTime' => $request->end_time,
                'days' => Cours::save_day_of_week($request->days),
                'act_StartDa' => $request->ac_start_date,
                'act_EndDa' => $request->ac_end_date,
                'year' => current_school_year(),
                'grade' => $request->grade,
                'level' => $request->level,
            ]);


   DB::commit();

            if (!$saved) {
                toastr()->error(__('site.please add data in the field'));
                return redirect()->route('admin.cours.add');
            } else {

                toastr()->success(__('site.Post created successfully!'));
                return redirect()->route('admin.cours.add');
            }




        } catch (\Throwable $th) {

            // throw $th;
            return $th;

            DB::rollback();
        }
    }
}
