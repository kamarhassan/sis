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
            $span_id = 'attendance_' . $value['id'] . '_';
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
            $span_id = 'attendance_' . $value->id . '_';
            $dataset[] = [
                'id' =>  $value->id,
                'Name' => $value->name,
                'attendance' => "<div class='row'><input type='number' name='attendance[$value->id]' value='$value->total_hours'></div> <span class='text-danger' id=$span_id></span>",

            ];
        }
        return $dataset;
    }




    function data_for_attendance_report($cours_id, array $array_of_selection, array $group_by)
    {
        $data =  DB::table('attendance_infos')
            ->where(['cours_id' => $cours_id])
            ->JOIN('attendance_details', 'attendance_infos.id', '=', 'attendance_details.attendance_info_id')
            ->JOIN('users', 'users.id', '=', 'attendance_details.user_id')
            ->select($array_of_selection)
            ->orderBy('attendance_infos.date')
            ->get();
        return $data->groupBy($group_by);
    }

    function dataset_attendance($data_for_attendance_report)
    {
        // return $data_for_attendance_report;
        if ($data_for_attendance_report->count() == 0)
            return false;
        $col_header = [];
        $dataset = [];
        $array_of_nb_hours = [];
        $temp_col_header = [];
        $count_row = 0;
        $colummns_type = [];
        foreach ($data_for_attendance_report as $key => $data_for_attendance_report_by_name) {
            $count_row += 1;
            $colummns_type_temp=[];
            foreach ($data_for_attendance_report_by_name as $date_attendance => $get_nb_hours) {
                $temp_col_header[] = $date_attendance;
                $array_of_nb_hours[] = $get_nb_hours[0]->total_hours;
                $colummns_type_temp[] = 'numeric';
            }
            $col_header = $temp_col_header;
            $temp_col_header = [];
            $nb_hours = array_merge([$key], $array_of_nb_hours);

            $dataset[] = $nb_hours; //array_unshift($nb_hours, $key);;
            $array_of_nb_hours = [];
        }

         $colummns_type = array_merge([''], $colummns_type_temp);

        array_unshift($col_header, 'name');
        $last_row = [];
        $Letter = 'B';
        $temp_letter;

        for ($i = 1; $i < count($col_header); $i++) {
            $temp_letter = $Letter++;
            $last_row[] = "=SUM(" . $temp_letter . '1:' . $temp_letter . ":$count_row)";
        }
        $dataset[] = array_merge([''], $last_row);
       
        return array(
            'col_header' => $col_header, 'dataset' => $dataset,
            'column_type' => $colummns_type
        );
    }
}
