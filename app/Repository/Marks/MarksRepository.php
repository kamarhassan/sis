<?php

namespace App\Repository\Marks;

use Carbon\Carbon;
use App\Models\Marks;
use App\Models\HeaderMarks;
use Illuminate\Support\Str;
use Hamcrest\Type\IsNumeric;
use PhpParser\Node\Expr\Cast\Double;

use function GuzzleHttp\Promise\each;

class MarksRepository implements MarksInterface
{
   public function StudentMarks($cours_id, $UserId)
   {
      return Marks::where(['cours_id' => $cours_id, 'user_id' => $UserId])->get();
   }

   public function validate_marks_befor_insert($student_data, $header_marks, $header_marks_object)
   {
      // return $header_marks;





      // $to_percent =  collect($marksObject)->groupBy('group');




      //  $to_calculate_total_for_std = [];

      $status = 'success';
      $data = $data_marks =  $error_index = [];
      foreach ($student_data as $key => $value) {
         $to_calculate_total_for_std = [];
         for ($i = 2; $i < count($value) - 2; $i++) {
            if (is_numeric($value[$i]) || is_null($value[$i])) {

               if (((float)$value[$i] > (float)$header_marks[$i][1]) || (float)$value[$i] < 0) {
                  $status = 'error';
                  $error_index[] = ['row' => $key + 1, 'col' => $header_marks[$i][0]];
                  break;
               } else {
                  $data_marks[$header_marks[$i][0]] = $value[$i];
                  $to_calculate_total_for_std[] = [
                     'group' => $header_marks[$i]['2'],


                     'mark' => $value[$i]
                  ];
               }
            } else {
               $status = 'error';
               $error_index[] = ['row' => $key + 1, 'col' => $header_marks[$i][0]];
               break;
            }


            $to_percent =  collect($to_calculate_total_for_std)->groupBy('group');

            $total_marks = 0;

            foreach ($to_percent as $key => $by_group) {
               // return $by_group[0]['group'];
               if ($by_group[0]['group'] == "") {

                  $total_marks += $by_group->sum('mark');
               } else {

                  $total_marks += $by_group->avg('mark');
               }
            }
         }

         // return     $to_percent;

         // $total = array_sum($data_marks);

         $data[] = [
            'header_mark_id' => $header_marks_object['id'],
            'cours_id' =>  $header_marks_object['cours_id'],
            'user_id' => $value[0],
            'std_marks' => $data_marks,
            'total' => $total_marks,
            'percent' => ($total_marks / $header_marks_object['total']) * 100,
            'average' => (20 / $header_marks_object['total']) * $total_marks,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
         ];
         $total_marks = 0;
      }

      return ['status' => $status, 'data' => $data, 'error_index' => $error_index];
   }

   public function header_marks_table($headmarks)
   {
      $head = [];
      $max_marks_ = [];
      $columns = [];
      foreach ($headmarks[0]['marks'] as $key => $value) {
         $head[] = [$value['marks_name'], $value['marks'], $value['group']];
         $max_marks_[] = $value['marks'];
      }
      // array_unshift($head, __('email'));
      array_unshift($head, __('name'));
      array_unshift($head, __('id'));
      array_unshift($max_marks_, __(''));
      array_push($head, __('Total mark'));
      array_push($head, __('percentage'));
      return  $head;
   }


   public function dataset_marks_table($students, $head, $total_sum)
   {
      // dd($head);
      $count = count($head);
      $from = $to = 'C';

      // dd($head);
      for ($i = 2; $i < $count - 1; $i++) {
         ++$to;
      }

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
      $lastIndex_headmarks = array_key_last($headmarks);
      $secondLastIndex_headmarks = $lastIndex_headmarks - 1;
      foreach ($headmarks as $key => $value) {
         if ($key > 1)
            $max_marks = $value[1];
         else
            $max_marks;

         switch ($key) {
            case ($key == 1 || $key == 0):
               $datatype = 'text';
               $isreadonly = true;
               $data = $value;
               break;
            case ($key == $secondLastIndex_headmarks):
               $datatype =  'numeric';
               $isreadonly = true;
               $data = $value;
               $max_marks = $total;
               break;
            case ($key == $lastIndex_headmarks):
               $datatype =  'numeric';
               $isreadonly = true;
               $data = $value;
               $max_marks = 100;
               break;

            default:
               $datatype =  'numeric';
               $isreadonly = false;
               $data = $value[0];
               break;
         }
         $columns[] = [
            'data' => $data,
            'type' =>  $datatype,
            'readOnly' => $isreadonly,
            'marks' => (float)$max_marks,
         ];
      }

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



   public function header_marks_table_only_show_data($headmarks)
   {
      $head = [];
      $max_marks_ = [];
      $columns = [];
      $sum_group = $count_group = 0;
      $to_create_header = collect($headmarks[0]['marks'])->groupBy('group');
      $count = 0;
      foreach ($to_create_header as $key => $Header_grouped) {
         foreach ($Header_grouped as $key => $value) {
            $head[] = [$value['marks_name'], $value['marks']];
            if ($value['group'] != null) {
               $sum_group += $value['marks'];
               $count_group++;
            }
            $max_marks_[] = $value['marks'];
         }
         if ($value['group'] != null) {
            // to sum group example reading 1,2,3,4 ... sum is for reading
            $head[] = ['total ' . $count++, $sum_group / $count_group];
         }

         $sum_group = $count_group = 0;
      }
      // array_unshift($head, __('email'));
      array_unshift($head, __('name'));
      array_unshift($head, __('id'));

      array_push($head, __('Total mark'));
      array_push($head, __('percentage'));

      return  $head;
   }


   public function columns_marks_data_type_only_show_data($headmarks, $total)
   {

      $columns = [];
      $max_marks = 0;
      $lastIndex_headmarks = array_key_last($headmarks);
      $secondLastIndex_headmarks = $lastIndex_headmarks - 1;
      foreach ($headmarks as $key => $value) {
         if ($key > 1)
            $max_marks = $value[1];
         else
            $max_marks;

         switch ($key) {
            case ($key == 1 || $key == 0):
               $datatype = 'text';
               $isreadonly = true;
               $data = $value;
               break;
            case ($key == $secondLastIndex_headmarks):
               $datatype =  'numeric';
               $isreadonly = true;
               $data = $value;
               $max_marks = $total;
               break;
            case ($key == $lastIndex_headmarks):
               $datatype =  'numeric';
               $isreadonly = true;
               $data = $value;
               $max_marks = 100;
               break;

            default:
               $datatype =  'numeric';
               $isreadonly = true;
               $data = $value[0];
               break;
         }
         $columns[] = [
            'data' => $data,
            'type' =>  $datatype,
            'readOnly' => $isreadonly,
            'marks' => (float)$max_marks,
         ];
      }

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



   public function  dataset_old_marks_students_table_show_only_data($all_students, $head, $cours_id, $header_marks_id)
   {
      $data = [];
      $marks_students = Marks::where(['cours_id' => $cours_id, 'header_mark_id' => $header_marks_id])->get();

      unset($head[0]);
      unset($head[1]);
      // unset($head[count($head)]);
   
      $index = array_search('percentage', $head);

      // Check if the value was found before unsetting
      if ($index !== false) {
         unset($head[$index]);
      }

      $index = array_search('Total mark', $head);

      // Check if the value was found before unsetting
      if ($index !== false) {
         unset($head[$index]);
      }

      // dd($head);
      // unset($head[count($head)]);
      // unset($head[1]);
      for ($i = 0; $i < count($head); $i++) {
      }


      $row_index = 0;

      $students_marks = [];
      foreach ($marks_students as $key_marks_students => $value_std_marks) {
         $i = 1;
         $columnsToColor=[];
         $from_ = 'C';
         $to_ = 'B';
         $row_index++;
         $marks = $value_std_marks['std_marks'];

         $result = [
            'id' => $value_std_marks['user_id'],
            'name' => $all_students->find($value_std_marks['user_id'])['name'],

         ];

         foreach ($head as $item) {
            $i++;
            $key = $item[0];
            $valueA = $item[1];
            if (array_key_exists($key, $marks)) {
               $result[$key] =  $marks[$key];
            } else {
               // $result[$key] =  $valueA;
               $result[$key] = '=average(' .  $from_ . $row_index . ':' . $to_ . $row_index . ')';
               $from_ = chr(ord($to_) + 2);
               $columnsToColor[] = $i;
            }
            $to_++;
         }
         $result['Total mark'] = $value_std_marks->total;
         $result['percentage'] = $value_std_marks->percent;


         
         $students_marks[] = $result;

         $result = [];
      }
      return  ['marks' => $students_marks, 'columnsToColor' => $columnsToColor];
   }
}
