<?php

namespace App\Repository\Attendance;

use App\Models\AttendanceInfo;
use Illuminate\Support\Facades\DB;

class AttendanceRepository implements AttendanceInterface
{
    public function get_attendance_info($date, $cours_id, $techear_id)
    {
        $attendance_info =   AttendanceInfo::where([
            'cours_id' => $cours_id,
            'teacher_id' => $techear_id,
            'date' => $date,
        ])->get();

        if ($attendance_info->count() == 0) {
            return false;
        }
        return  $attendance_info;
    }

    public function dataset_take_new_attendance($array_of_data)
    {
        $dataset = [];
        if ($array_of_data->count() == 0)
            return $dataset;
        foreach ($array_of_data as $key => $value) {
            $span_id ='attendance_'. $value['id'].'_';
            $dataset[] = [
                'id' => $value['id'],
                'Name' => $value['name'],
                'attendance' => "<div class='row'><input type='number' name='attendance[$value[id]]' > </div> <span class='text-danger' id=$span_id></span>",

            ];
        }
        return $dataset;
    }

    public function old_attendance_details($id_attendance_info)
    {

        $array_of_selection = ['users.name as name', 'users.id as id', 'attendance_details.total_hours as total_hours'];

        return  DB::table('attendance_infos')
            ->where('attendance_infos.id', $id_attendance_info)
            ->JOIN('attendance_details', 'attendance_infos.id', '=', 'attendance_details.attendance_info_id')
            ->JOIN('users', 'users.id', '=', 'attendance_details.user_id')
            ->select($array_of_selection)
            ->get();
    }


    public function dataset_new_or_update_attendance($array_of_data)
    {
        $dataset = [];
        if ($array_of_data->count() == 0)
            return $dataset;
        foreach ($array_of_data as $key => $value) {
        $span_id ='attendance_'.$value->id.'_';
            $dataset[] = [
                'id' =>  $value->id,
                'Name' => $value->name,
                'attendance' => "<div class='row'><input type='number' name='attendance[$value->id]' value='$value->total_hours'></div> <span class='text-danger' id=$span_id></span>",

            ];
        }
        return $dataset;
    }
}
