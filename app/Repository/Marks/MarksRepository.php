<?php

namespace App\Repository\Marks;

use App\Models\HeaderMarks;
use Carbon\Carbon;
use App\Models\Marks;
use Hamcrest\Type\IsNumeric;
use PhpParser\Node\Expr\Cast\Double;

class MarksRepository implements MarksInterface
{
   public function StudentMarks($cours_id, $UserId)
   {
      return Marks::where(['cours_id'=>$cours_id,'user_id'=>$UserId])->get();

   }

   public function validate_marks_befor_insert($student_data, $header_marks, $header_marks_object)
   {
      // return $$header_marks;
      $status = 'success';
      $data = $data_marks =  $error_index = [];
      foreach ($student_data as $key => $value) {
         // dd($value);
         for ($i = 2; $i < count($value) - 2; $i++) {
            if (is_numeric($value[$i]) || is_null($value[$i])) {

               if (((float)$value[$i] > (float)$header_marks[$i][1]) || (float)$value[$i] < 0) {
                  $status = 'error';
                  $error_index[] = ['row' => $key + 1, 'col' => $header_marks[$i][0]];
                  break;
               } else {
                  $data_marks[$header_marks[$i][0]] = $value[$i];
               }
            } else {
               $status = 'error';
               $error_index[] = ['row' => $key + 1, 'col' => $header_marks[$i][0]];
               break;
            }
         }

         $total = array_sum($data_marks);
         $data[] = [
            'header_mark_id' => $header_marks_object['id'],
            'cours_id' =>  $header_marks_object['cours_id'],
            'user_id' => $value[0],
            'std_marks' => $data_marks,
            'total' => $total,
            'percent' => ($total / $header_marks_object['total']) * 100,
            'average' => (20 / $header_marks_object['total']) * $total,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
         ];
      }

      return ['status' => $status, 'data' => $data, 'error_index' => $error_index];
   }

   public function header_marks_table($headmarks)
   {
      $head = [];
      $max_marks_ = [];
      $columns = [];
      foreach ($headmarks[0]['marks'] as $key => $value) {
         $head[] = [$value['marks_name'], $value['marks']];
         $max_marks_[] = $value['marks'];
      }
      // array_unshift($head, __('email'));
      array_unshift($head, __('name'));
      array_unshift($head, __('id'));
      array_unshift($max_marks_, __(''));

      return  $head;
   }


   public function dataset_marks_table($students, $head)
   {
      // dd($head);
      $count = count($head);
      $from = $to = 'C';
      $total_sum = 0;
      // dd($head);
      for ($i = 2; $i < $count - 1; $i++) {
         ++$to;
         $total_sum += $head[$i][1];
      }
      $total_sum += $head[$count - 1][1]; // to sum last elemnt
      //  --$to;
      $std =  $students->map(function ($student) {
         return collect($student)->only(['id', 'name', '', '', '']);
      });

      $std_name_id = $std->values(); // -> value to remove index from collection
      $data = [];
      $row_index = 1;
      foreach ($std_name_id as $std) {
         $data[] = [
            'id' => $std['id'],
            'name' => $std['name'],
            'sum' => '=sum(' . $from . $row_index . ':' . $to . $row_index . ')', // need edit range for sum
            'average' => '=(sum(' . $from . $row_index . ':' . $to . $row_index . ')/' . $total_sum . ')*100', // need edit range for sum
         ];
         $row_index++;
      }

      return  $data;
   }

   public function columns_marks_data_type($headmarks, $total)
   {

      $columns = [];
      $max_marks = 0;
      foreach ($headmarks as $key => $value) {
         if ($key > 1)
            $max_marks = $value[1];
         else
            $max_marks;
         ($key == 1 || $key == 0)  ?  $datatype = 'text' :  $datatype =  'numeric';
         ($key == 1 || $key == 0) ?  $isreadonly = true :  $isreadonly = false;
         ($key == 1 || $key == 0) ?  $data = $value :  $data = $value[0];
         $columns[] = [
            'data' => $data,
            'type' =>  $datatype,
            'readOnly' => $isreadonly,
            'marks' => (float)$max_marks,
         ];
      }
      $columns[] = [
         'data' => 'sum',
         'type' =>   'numeric',
         'readOnly' => false,
         'marks' => $total,
      ];
      $columns[] = [
         'data' => 'average',
         'type' =>   'numeric',
         'readOnly' => false,
         'marks' => 100
      ];
      return $columns;
      /**
       * 
      { data: 1, type: "text" ,      readOnly: true },
      { data: 2, type: "text" },
      { data: 3, type: "text" },
      {
      data: 4,
      type: "date",
      allowInvalid: false
      },
      { data: 5, type: "text" },

      {
      data: 7,
      type: "numeric"
      },
       */
   }

   public function  dataset_old_marks_students_table($all_students, $head, $cours_id, $header_marks_id)
   {
      $data = [];
      $marks_students = Marks::where(['cours_id' => $cours_id, 'header_mark_id' => $header_marks_id])->get();

      $header_marks = HeaderMarks::find($header_marks_id);
      $total =  $header_marks->total;

      // return $all_students;
      $row_index = 0;
      $from = $to = 'C';


      $count_headers =  count($head);

      for ($i = 2; $i < $count_headers - 1; $i++) {
         ++$to;
      }

      foreach ($marks_students as $key_marks_students => $value) {
         $row_index++;
         $data[$key_marks_students] = [
            'id' => $value['user_id'],
            'name' => $all_students->find($value['user_id'])['name'],
            'sum' => '=sum(' . $from . $row_index . ':' . $to . $row_index . ')', // need edit range for sum
            'average' => '=(sum(' . $from . $row_index . ':' . $to . $row_index . ')/' . $total . ')*100', // need edit range for sum
         ];
         foreach ($value['std_marks'] as $key => $value_std_marks) {

            $data[$key_marks_students][$key] =  $value_std_marks; // set key is name of marks 

            /***
             * data returned such as this data
             *    {
                  "id": 250,
                  "name": "std16 std16 std16",
                  "شفهي": "3.15",  #key is شفهي value is 3.15
                  "نص مسموع": "2",
                  "خطي": "25"
                  },
             */
         }
      }
      return $data;
   }
}
