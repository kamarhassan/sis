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
        return $request;



        //  : "English",
        // : "Elementary level 1",
        // : "2022-04-06",
        // : "2022-04-06",
        // : null,
        // : null,
        // ac_start_date: "2022-04-07",
        // : "2022-04-07",
        // : null,
        // : "اختر الدورة من فضلك",
        // : "Hassan Kamar 1",
        // : "465"
              Cours::create([
            'startDate' =>$request->start_date,
            'endDate' =>$request->end_date,
            'maxStd' =>$request->max_std_number,

            'status' =>$request->status,
            'teachername' =>$request->teacher_name,
            'teacherFee' =>$request->teacher_fee,
            'startTime' =>$request->start_time,
            'endTime' =>$request->end_time,
            // 'days' =>$request->,
            'act_StartDa' =>$request->ac_start_date,
            'act_EndDa' =>$request->ac_end_date,
            'year' =>current_school_year(),
            'grade' =>$request->grade,
            'level' =>$request->level,
        ]);


        //return view('admin.cours.index');
    }
}
