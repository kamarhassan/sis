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

class CoursRepository implements CoursInterface
{

    public function all_cours()
    {
        // TODO: Implement all_cours() method.
        return Cours::Selection_with_grad_and_level();
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
}
