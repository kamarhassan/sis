<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrUpdateAttendanceRequest;
use App\Http\Requests\SchoolYearRequest;
use App\Models\Years;
use App\Models\Cours;
use Illuminate\Http\Request;

class SchoolYearController extends Controller
{


   public function index()
   {
      $years = Years::get();
      return view('admin.setup.schoolyear.index', compact('years'));
   }

   public function save_edit(SchoolYearRequest $request)
   {

      try {
         // return $request;
         $year =   Years::updateOrCreate(
            [
               'id' => $request->schoolyearid
            ],
            [
               'year' => date('Y', strtotime($request->start_date)) . '-' . date('Y', strtotime($request->end_date)),
               'start' => $request->start_date,
               'end' => $request->end_date
            ]
         );

         if (!$year) {
            $status = 'error';
            $message = __('site.Post created unsuccessfully!');
            $route = route('#');
         } else {
            $status = 'success';
            $message = __('site.Post created successfully!');
            $route = route('admin.schoolyear.all');
         }
         return response()->json(['message' => $message, 'status' => $status, 'route' => $route]);
      } catch (\Throwable $th) {
         throw $th;
      }
   }


   public function delete(Request $request)
   {

      try {
         $schoolyear =  Years::find($request->id);




         if (!$schoolyear) {
            $status = 'error';
            $message =  __('site.you have error');
         } else {
            if (!Cours::where('year', $schoolyear->year)->first()) {
               $schoolyear->delete();
               $status = 'success';
               $message = __('site.deleted_msg_swal_fire');
            }else {
               $status = 'error';
               $message =  __('site.can\'t delete this year beecause is already used in class');
            }
         }
         return response()->json(['message' => $message, 'status' => $status]);
      } catch (\Throwable $th) {
         throw $th;
      }




      return $request;
   }



   public function get_info_to_edit($school_year_id)
   {
      $schoolyear =  Years::find($school_year_id);
      if (!$schoolyear) {
         $status = 'error';
         $message =  __('site.you have error');
         $schoolyear = null;
      } else {

         $status = 'success';
         $message = __('site.deleted_msg_swal_fire');
      }
      return response()->json(['schoolyear' => $schoolyear, 'status' => $status]);
   }
}