<?php

namespace App\Repository\Attendance;

interface AttendanceInterface
{
public function get_attendance_info($date,$cours_id,$techear_id);
public function dataset_take_new_attendance($array_of_data);
// public function dataset_update_or_view_attendance($array_of_data);

public function old_attendance_details($id_attendance_info);
public function dataset_new_or_update_attendance($array_of_data);

public function data_for_attendance_report($cours_id,array $array_of_selection,array $group_by);
public function dataset_attendance($array_of_data);

}
