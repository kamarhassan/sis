<?php

namespace App\Http\Controllers\Admin;

use App\Models\Marks;
use App\Models\HeaderMarks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Marks\MarksActionFromAdminRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Repository\Marks\MarksInterface;
use App\Repository\Students\StudentsInterface;
use App\Http\Requests\Marks\StoreMarksGeneralInfoRequest;

class MarksController extends Controller
{
   //  return view();

   protected $studentsrepos;
   protected $marksrepository;




   public function __construct(StudentsInterface $stdinterface, MarksInterface $marksInterface)
   {
      $this->studentsrepos = $stdinterface;
      $this->marksrepository = $marksInterface;
   }


   public function add_general_info($cours_id)
   {

      $HeaderMarks = HeaderMarks::where('cours_id', $cours_id)->get();
      $HeaderMarks_of_teacher_ = HeaderMarks::select('id', 'marks')->where('teacher_id', auth()->user()->id)->groupBy(['marks'])->get()->values();
      $HeaderMarks_of_teacher = [];
      foreach ($HeaderMarks_of_teacher_ as $key => $value) {

         $HeaderMarks_of_teacher[$value['id']] = $value['marks'];
      }
      $HeaderMarks_of_teacher;
      if ($HeaderMarks->count() > 0) {
         toastr()->warning(__('site.header marks al ready exist to edit call to admin'));
         return redirect()->route('admin.take.attendance.students');
      }

      return view('admin.marks.add-general-marks', compact('cours_id', 'HeaderMarks_of_teacher'));
   }

   public function store_general_info(StoreMarksGeneralInfoRequest $request)
   {

      //   return $request;

      for ($i = 0; $i < count($request->marks_name); $i++) {
         $marksObject[] = [
            'id' => 'markid' . $i,
            'marks_name' => $request->marks_name[$i],
            'marks' => $request->marks[$i],
            'percent' => $request->percent[$i],
            'group' =>  $request->group[$i]
         ];
      }

      $to_percent =  collect($marksObject)->groupBy('group');


      $percentage = 0;
      $total_marks = 0;

      foreach ($to_percent as $key => $by_group) {
         if ($key == "") {
            $percentage += $by_group->sum('percent');
            $total_marks += $by_group->sum('marks');
         } else {
            $percentage += $by_group->avg('percent');
            $total_marks += $by_group->avg('marks');
         }
      }
      // return $to_percent;
      if (round($percentage) != 100) {
         $message = __('site.the sum of percent must be equal 100 please edit percent and try your % is ') . round($percentage);
         $status = 'error';

         return response()->json(['status' => $status, 'message' => $message]);
      }


      $HeaderMarks = HeaderMarks::create([
         'cours_id'    => Crypt::decryptString($request->cours_id),
         'teacher_id'    => Auth::user()->id,
         'marks'    => $marksObject,
         'total'    =>   $total_marks,
         'percent'    =>   $percentage,
      ]);



      return response()->json([
         'status' => 'success',
         'message' => __('site.marks save successfully'),
         'route' => route('admin.get.students.to.add.marks', $request->cours_id),
      ]);
   }



   public function get_std_to_add__or_update_marks($cours_id_)
   {

      $cours_id = Crypt::decryptString($cours_id_);
      $HeaderMarks = HeaderMarks::where('cours_id', $cours_id)->get();
      if ($HeaderMarks->count() == 0) {
         return redirect()->route('admin.add.marks.cours', $cours_id_);
      }
      $status_of_insert_and_update_marks =   $HeaderMarks[0]['status'];
      $students = $this->studentsrepos->students_for_cours_defined($cours_id);

      $header_marks = $this->marksrepository->header_marks_table($HeaderMarks);

      $columns = $this->marksrepository->columns_marks_data_type($header_marks, $HeaderMarks[0]['total']);
      //   $studentsdata = $this->marksrepository->dataset_marks_table($students, $header_marks);
      $mark_std =  Marks::where('header_mark_id', $HeaderMarks[0]['id'])->where('cours_id', $cours_id)->get();

      if ($mark_std->count() > 0) {
         /**
          * if students have marks
          */

         $studentsdata =   $this->marksrepository->dataset_old_marks_students_table($students, $header_marks, $cours_id, $HeaderMarks[0]['id']);
      } else {
         /**
          * if students don't have marks
          */

         $studentsdata = $this->marksrepository->dataset_marks_table($students, $header_marks, $HeaderMarks[0]['total']);
      }

      return view('admin.marks.add-students-marks', compact('header_marks', 'studentsdata', 'columns', 'cours_id', 'status_of_insert_and_update_marks'));
   }


   public function post_or_update_marks_std(Request $request)
   {


      try {
         // return $request;
         DB::beginTransaction();


         $HeaderMarks = HeaderMarks::where('cours_id', $request->cours_id)->get();
         $header_marks = $this->marksrepository->header_marks_table($HeaderMarks);
         //  return   $header_marks[2][1];
         $message = null;
         $t = [];
         $DataAfterValidate =  $this->marksrepository->validate_marks_befor_insert($request->data, $header_marks, $HeaderMarks[0]);

         if ($DataAfterValidate['status'] != 'error') {
            foreach ($DataAfterValidate['data'] as $key => $value) {

               Marks::updateOrCreate([
                  'header_mark_id' => $value['header_mark_id'],
                  'cours_id' => $value['cours_id'],
                  'user_id' => $value['user_id'],
               ], [
                  'header_mark_id' => $value['header_mark_id'],
                  'cours_id' => $value['cours_id'],
                  'user_id' => $value['user_id'],
                  'std_marks' => $value['std_marks'],
                  'total' => $value['total'],
                  'percent' => $value['percent'],
                  'average' => $value['average'],
               ]);
            }
            $status = $DataAfterValidate['status'];
            $message = __('site.insert marks successfully');
         } else {
            $status = $DataAfterValidate['status'];
            $message =  __('site.insert marks failed please fix the errors');
         }
         DB::commit();
         return response()->json([
            'message' => $message,
            'status' =>  $status,
            'route' => '#',
            'error_index' => $DataAfterValidate['error_index']
         ]);
      } catch (\Throwable $th) {
         DB::rollback();
         throw $th;
      }
   }




   public function admin_report_and_action($cours_id_)
   {
      $cours_id = Crypt::decryptString($cours_id_);
      $HeaderMarks = HeaderMarks::where('cours_id', $cours_id)->get();
      if ($HeaderMarks->count() == 0) {

         return redirect()->route('admin.add.marks.cours', $cours_id_);
      }
      $header_marks_id = $HeaderMarks[0]['id'];

      $students = $this->studentsrepos->students_for_cours_defined($cours_id);
      $header_marks = $this->marksrepository->header_marks_table_only_show_data($HeaderMarks);
      $columns = $this->marksrepository->columns_marks_data_type_only_show_data($header_marks, $HeaderMarks[0]['total']);

      $mark_std =  Marks::where('header_mark_id', $HeaderMarks[0]['id'])->where('cours_id', $cours_id)->get();
      if ($mark_std->count() > 0) {
         /**
          * if students have marks
          */
         //   return  ['marks'=>$students_marks,'columnsToColor'=>$columnsToColor];
         $dataset_old_marks_students_table_show_only_data =   $this->marksrepository->dataset_old_marks_students_table_show_only_data($students, $header_marks, $cours_id, $HeaderMarks[0]['id']);
         $studentsdata =  $dataset_old_marks_students_table_show_only_data['marks'];
         $columnsToColor =  $dataset_old_marks_students_table_show_only_data['columnsToColor'];
      } else {
         /**
          * if students don't have marks
          */

         $studentsdata = $this->marksrepository->dataset_marks_table($students, $header_marks, $HeaderMarks[0]['total']);
      }
      return view('admin.marks.admin-report-action', compact('header_marks', 'studentsdata', 'columns', 'cours_id', 'header_marks_id', 'columnsToColor'));
   }



   public function disable_enable_take_marks(MarksActionFromAdminRequest $request)
   {
      // return $request; //Crypt::decryptString($this->cours_id) 
      // Crypt::decryptString($this->header_marks_id)

      try {
         //code...

         $header_marks = HeaderMarks::find(Crypt::decryptString($request->header_marks_id));
         $header_marks['status'] === 1 ? $status = 0 : $status = 1;
         // dd($status);
         $header_marks->status = $status;
         $is_updated = $header_marks->save();
         if ($is_updated) {
            $status_of_update = 'success';
            $status === 0 ? $message = __('site.insert or update is lock') : $message = __('site.insert or update is unlock');
         } else {
            $status_of_update = 'error';
            $message = __('site.you site.you have error');
         }

         return response()->json(['status' => $status_of_update, 'message' => $message, 'route' => "#"]);
      } catch (\Throwable $th) {
         throw $th;
      }
   }
   public function reset_marks(Request $request)
   {
      try {
         DB::beginTransaction();
         // return $request;
         //   dd(Crypt::decryptString($request->id));
         $marks_deleted = Marks::where('header_mark_id', Crypt::decryptString($request->id))->delete();
         $header_marls_deleted = HeaderMarks::find(Crypt::decryptString($request->id))->delete();
         DB::commit();
         if ($marks_deleted &&  $header_marls_deleted) {
            $message = __('site.Marks reset has been success');
            $status = 'success';
            $route = route('admin.take.attendance.students');
         } else {
            $message = __('site.faild to resset marks of this class');
            $status = 'error';
            $route = '#';
         }
         return response()->json(['status' => $status, 'message' => $message, 'route' => $route]);
      } catch (\Throwable $th) {
         DB::rollBack();
         throw $th;
      }
   }
   public function export_marks(MarksActionFromAdminRequest $request)
   {
      return $request;
   }


   public  function store_general_info_marks_from_old(Request $request)
   {
      return $request;
   }
}
