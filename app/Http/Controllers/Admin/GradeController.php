<?php


namespace App\Http\Controllers\Admin;


use App\Http\Requests\EditGradeRequest;
use App\Traits\Image;
use Exception;
use Exeption;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GradesRequest;

use App\Models\Grade;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class GradeController extends Controller
{
   use Image;

   public function __construct()
   {
   }

   public function create()
   {
      $grade = Grade::select()->get();
      return view('admin.setup.grade.create', compact('grade'));
   }

   public function store(GradesRequest $request)
   {

      try {
         DB::beginTransaction();
         $nb_grade = count($request->grades);

         $grade = [];
         for ($i = 0; $i < $nb_grade; $i++) {
            ($request->has('image') && array_key_exists($i, $request->image)) ?
               $file_name = $this->saveImage($request->image[$i], 'public/files/images/categories') : $file_name = null;
            if ($request->grades[$i] != '') {


               $grade[] = [
                  'grade' => $request->grades[$i],
                  'image' => $file_name,
                  'description' => $request->description[$i],
                  'created_at' => Carbon::now(),
                  'updated_at' => Carbon::now(),
               ];

            }
         }

         $inserted = Grade::insert($grade);
         DB::commit();
         if ($inserted) {

            $message = __('site.Post created successfully!');
            $status = 'success';
            $route = route('admin.grades.add');

         } else {
            $message = __('site.you have error');
            $status = 'error';
            $route = '#';
         }
         return response()->json([
            'message' => $message,
            'status' => $status,
            'route' => $route
         ]);
         // print_r( $grade_to_insert[]);

      } catch (Exeption $ex) {
         toastr()->error(__('site.you have error'));
         // return $ex;
         DB::rollback();
      }
   }

   public function delete(Request $request)
   {

      try {
         $grade = Grade::find($request->id);
         if (!$grade) {
            toastr()->error(__('site.grade note defined'));
            return redirect()->route('admin.grades.add');
         } else {
            $this->removeImagefromfolder($grade->image);
            $deleted = $grade->delete();
            if (!$deleted) {
               $notification = [
                  'message' => __('site.payment faild '),
                  'status' => 'error',

               ];
            } else {
               $notification = [
                  'message' => __('site.payment has delete success'),
                  'status' => 'success',
               ];
            }
            return response()->json($notification);
         }
      } catch (Exception $th) {
         toastr()->error(__('site.you have error'));
      }
   }

   public function get_category_information($category_id)
   {

      $data = Grade::find($category_id);
      return view('admin.setup.grade.edit-modal', compact('data'));

   }

   public function update(EditGradeRequest $request)
   {

//      return response()->json($request);
      try {
         $grade = Grade::find($request->category_id);
//         return response()->json($grade);
         if (!$grade) {
            
            
            $message = __('site.grade note defined');
            $status = 'error';
            $route = route('admin.grades.add');
            return response()->json([
               'message' => $message,
               'status' => $status,
               'route' => $route
            ]);
         } else {
            $file_name = $grade->image;
            if ($request->has('image')) {
               $this->removeImagefromfolder($file_name);
               $file_name = $this->saveImage($request->image, 'public/files/images/categories');
            }

            $grade_updated = $grade->update([
               'grade' => $request->grades,
               'image' => $file_name,
               'description' => $request->description,
            ]);

            if ($grade_updated) {
               $message = __('site.grade succefuly update');
               $status = 'success';
               $route = route('admin.grades.add');
            } else {
               $message = __('site.grade faild to update');
               $status = 'error';
               $route = '#';
            }
            return response()->json([
               'message' => $message,
               'status' => $status,
               'route' => $route
            ]);
         }
      } catch (Exception $th) {

         $notification = [
            'message' => __('site.you have error'),
            'status' => 'error',

         ];
         return response()->json($notification);
         //   toastr()->error(__('site.you have error'));
      }
   }
   
   
   
   public function delete_img(Request $request){
//    dd($request);
        
      
       

      try {
         $grade = Grade::find($request->id);
         if (!$grade) {
            $message = __('site.grade note defined');
            $status = 'error';
            $route = route('admin.grades.add');
            return response()->json([
               'message' => $message,
               'status' => $status,
               'route' => $route
            ]);
         } else {
            $this->removeImagefromfolder($grade->image);

            $grade_updated = $grade->update([
               'image' => null,
            ]);

            if ($grade_updated) {
               $message = __('site.grade succefuly update');
               $status = 'success';
               $route = route('admin.grades.add');
            } else {
               $message = __('site.grade faild to update');
               $status = 'error';
               $route = '#';
            }
            return response()->json([
               'message' => $message,
               'status' => $status,
               'route' => $route
            ]);
         }
      } catch (Exception $th) {

         $notification = [
            'message' => __('site.you have error'),
            'status' => 'error',

         ];
         return response()->json($notification);
         //   toastr()->error(__('site.you have error'));
      }
   }
   
}
