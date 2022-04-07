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
        return view('admin.cours.create', compact('grade', 'level', 'status_od_cours','teacher'));
    }

    public function store(InsertCoursRequest $request)
    {
        return $request;


        Cours::create([
                // grade: "English",
                // level: "Elementary level 1",
                // start_date: "2022-04-06",
                // end_date: "2022-04-06",
                // start_time: null,
                // end_time: null,
                // ac_start_date: "2022-04-07",
                // ac_end_date: "2022-04-07",
                // max_std_number: null,
                // status: "اختر الدورة من فضلك",
                // teacher_name: "Hassan Kamar 1",
                // teacher_fee: "465"
        ]);


        //return view('admin.cours.index');
    }
}
