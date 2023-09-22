<?php

namespace App\Repository\Marks;

interface MarksInterface
{
   public function StudentMarks($cours_id, $UserId);
   public function validate_marks_befor_insert($data, $header_marks,$header_marks_object);
   public function header_marks_table($headmarks);
   public function dataset_marks_table($students, $head,$total_sum);
   public function dataset_old_marks_students_table($students, $head,$cours_id,$header_marks_id);
   public function columns_marks_data_type($headmarks,$total);
   
   
   public function  header_marks_table_only_show_data($headmarks);
   public function columns_marks_data_type_only_show_data($headmarks,$total);
   public function dataset_old_marks_students_table_show_only_data($students, $head,$cours_id,$header_marks_id);
   
   
}
