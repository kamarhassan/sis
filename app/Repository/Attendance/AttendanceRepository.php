<?php

namespace App\Repository\Attendance;

use App\Models\AttendanceDetail;
use App\Models\AttendanceInfo;
use App\Models\Cours;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\IsTrue;

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

      $array_of_selection = ['users.name as name', 'attendance_infos.date as date_', 'users.id as id', 'attendance_details.total_hours as total_hours', 'attendance_infos.cours_id as cours_id'];
      return  DB::table('attendance_infos')
         ->where('attendance_infos.id', $id_attendance_info)

         ->JOIN('courss', 'attendance_infos.cours_id', '=', 'courss.id')
         ->JOIN('studentsregistrations', 'courss.id', '=', 'studentsregistrations.cours_id')
         ->JOIN('users', 'studentsregistrations.user_id', '=', 'users.id')

         ->JOIN('attendance_details', 'users.id', '=', 'attendance_details.user_id')
         // ->JOIN('attendance_details', 'attendance_infos.id', '=', 'attendance_details.attendance_info_id')
         ->where('attendance_details.attendance_info_id', $id_attendance_info)
         ->select($array_of_selection)
         // ->JOIN('users', 'users.id', '=', 'attendance_details.user_id')
         ->get();
      //  return   $std[0] ->cours_id;

      //    $std_of_cours = DB::table('studentsregistrations')
      //     ->where('cours_id', $std[0]->cours_id)
      //     ->JOIN('users', 'users.id', '=', 'studentsregistrations.user_id')
      //     ->select(['users.name as name', 'users.id as id'])
      //     ->get();

      // return  $std;
   }


   public function dataset_new_or_update_attendance($array_of_data)
   {
      //  return $array_of_data;
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

      if ($data_for_attendance_report->count() == 0)
         return false;
      $dataset = [];
      $array_of_nb_hours = [];
      $count_row = 0;
      foreach ($data_for_attendance_report as $key
         /** key is name of students */
         => $data_for_attendance_report_by_name) {
         $count_row += 1;
         foreach ($data_for_attendance_report_by_name as $date_attendance => $get_nb_hours) {
            $array_of_nb_hours[$date_attendance] = $get_nb_hours[0]->total_hours;
         }
         $nb_hours_with_name = array_merge(['std_name' => $key], ['attendance_hours' => $array_of_nb_hours]);
         $dataset[] = $nb_hours_with_name; //array_unshift($nb_hours, $key);;
         $array_of_nb_hours = [];
      }
      return     $dataset;
   }

   function header_column($cours_id)
   {
      $data = AttendanceInfo::where('cours_id', $cours_id)
         ->select(['date as data', 'total_hours  as max_attendance_hours_per_days'])->get();
      //   return $data->sort();
      // $col_header_name = ['name'];
      $temp_max_attendance_hours_per_days = [];
      foreach ($data as $key => $attendance_date) {
         $col_header_name[] = $attendance_date['data'];
         $temp_max_attendance_hours_per_days[$attendance_date['data']] = $attendance_date['max_attendance_hours_per_days'];
      }
      sort($col_header_name);

      array_unshift($col_header_name, 'name');

      $max_attendance_hours_per_days['std_name'] = __('site.max attendance hours per days');
      $max_attendance_hours_per_days['attendance_hours'] = $temp_max_attendance_hours_per_days;
      /**  
       * 
       * to return the max of attendace hours per days it is for days isn't for students
       * 
       */


      // array_unshift($max_attendance_hours_per_days, __('site.max attendance hours per days'));
      return  ['data' => $data, 'header_name' =>  $col_header_name, 'max_attendance_hours_per_days' => $max_attendance_hours_per_days];
   }



   public function delete_attendance_details($attendance_info_id)
   {
      try {
         DB::beginTransaction();
         $attendance_detail = AttendanceDetail::where('attendance_info_id', $attendance_info_id)->get('id');
         if (!$attendance_detail)
            return false;

         $attendance_detail_delete = AttendanceDetail::where('attendance_info_id', $attendance_info_id)->delete();
         $attendance_info_delete = AttendanceInfo::find($attendance_info_id)->delete();
         DB::commit();
         if ($attendance_detail_delete && $attendance_info_delete)
            return true;

         return false;
      } catch (\Throwable $th) {
         DB::rollBack();
         //throw $th;
      }
   }

   public function reset($cours_id, $attendance_date)
   {
   }

   public function attendance_info_has_attendance_details($cours_id, $attendance_date)
   {
      $attendance_info = AttendanceInfo::where(['cours_id' => $cours_id, 'date' => $attendance_date])->first();
      if (!$attendance_info)
         return collect();
      return $attendance_details = AttendanceDetail::where('attendance_info_id', $attendance_info['id'])->get();
   }
   public function cours_status_attendance($cours_id)
   {
      $attendance_info = AttendanceInfo::where(['cours_id' => $cours_id])->get();
      foreach ($attendance_info as $key => $value) {
         if ($value == 1 || $value == "")
            return 1; // 1 
      }
      return 0;
   }
}
