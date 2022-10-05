<?php

/**
 * Created by PhpStorm.
 * User: Hassan
 * Date: 4/10/2022
 * Time: 1:23 PM
 */

namespace App\Repository\Cours;

use App\Models\Grade;
use App\Models\level;

use App\Models\Cours;
use App\Models\CoursFee;
use App\Models\Currency;

class CoursRepository implements CoursInterface
{

    public function all_cours()
    {

        // TODO: Implement all_cours() method.
        $array_of_data = [
            'courss.id',
            'courss.status',
            'admins.name',
            'courss.startDate',
            'courss.endDate',
            'courss.act_StartDa',
            'courss.act_EndDa',
            'courss.startTime',
            'courss.endTime',
            'levels.level',
            'grades.grade'
        ];
        return  Cours::join('grades', 'grade_id', '=', 'grades.id')
            ->join('levels', 'level_id', '=', 'levels.id')
            ->JOIN('admins', 'teacher_id', '=', 'admins.id')
            ->where('year', current_school_year())
            ->orderBy('courss.id', 'asc')
            ->get($array_of_data);
    }
    public function store_cours($request, $teacher_id)
    {

        // TODO: Implement all_cours() method.
        $saved = Cours::create([
            'startDate' => $request->start_date,
            'endDate' => $request->end_date,
            'maxStd' => $request->max_std_number,
            'status' => $request->status,
            'teacher_id' => $teacher_id,
            'teacherFee' => $request->teacher_fee,
            'description' => $request->description,
            'startTime' => $request->start_time,
            'endTime' => $request->end_time,
            'days' => Cours::save_day_of_week($request->days),
            'act_StartDa' => $request->ac_start_date,
            'act_EndDa' => $request->ac_end_date,
            'year' => current_school_year(),
            'grade_id' => Grade::GetIdByName($request->grade),
            'level_id' => Level::GetIdByName($request->level),

        ]);
        // dd($saved->id);
        return $saved->id;
    }





    public  function  update_cours($request, $teacher_id, $cours_id)
    {

        $cours = Cours::find($cours_id);
        if (!$cours)
            return false;

        $cours_updated = $cours->update([
            'startDate' => $request->start_date,
            'endDate' => $request->end_date,
            'maxStd' => $request->max_std_number,
            'status' => $request->status,
            'teacher_id' => $teacher_id,
            'teacherFee' => $request->teacher_fee,
            'description' => $request->description,
            'startTime' => $request->start_time,
            'endTime' => $request->end_time,
            'days' => Cours::save_day_of_week($request->days),
            'act_StartDa' => $request->ac_start_date,
            'act_EndDa' => $request->ac_end_date,
            'year' => current_school_year(),
            'grade_id' => Grade::GetIdByName($request->grade),
            'level_id' => Level::GetIdByName($request->level),

        ]);
        return $cours_updated;
    }

    public function is_defined($id)
    {
        $cours = Cours::find($id);
        if (!$cours)
            return false;
        return $cours;
    }


    public function open_and_postopen_cours()
    {
        return Cours::where('status', 'open')->orWhere('status', 'postopen')->with('grade', 'level')->get();
    }
    public function cours_fee_currency($cours_id)
    {
        $cours_fee = CoursFee::where('cours_id', $cours_id)->first();
        $cours_curency = Currency::find($cours_fee['currencies_id']);
        if ($cours_curency)
            return $cours_curency;
        return false;
    }

    public function cours_theacher_name($cours){
        if (!$cours)
        return false;
    return  $theacher_name = $cours->teacher_name;
    }

}// end of class
