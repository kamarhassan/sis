<?php

namespace App\Repository\Marks;

interface MarksInterface
{
   public function StudentMarks($cours_id, $UserId);
   public function validate_marks_befor_insert($data, $header_marks,$header_marks_object);
   public function header_marks_table($headmarks);
   public function dataset_marks_table($students, $head);
   public function dataset_old_marks_students_table($students, $head,$cours_id,$header_marks_id);
   public function columns_marks_data_type($headmarks,$total);
}
