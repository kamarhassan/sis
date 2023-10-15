<?php

namespace App\Http\Controllers\Admin;

use App\Traits\Image;
use Illuminate\Http\Request;
use App\Models\NotificationAdmin;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Repository\User\UserInterface;
use App\Repository\Cours\CoursInterface;
use App\Repository\Cours_fee\CoursFeeInterface;
use App\Repository\AdminNotification\AdminNotificationInterface;
use Illuminate\Notifications\Notification;

class AdminNotificationController extends Controller
{
   use Image;
   protected $coursfee;
   protected $adminnotification;
   protected $userrepository;
   protected $coursrepository;
   protected $coursfeerepository;

   public function __construct(
      CoursFeeInterface $coursfee,
      AdminNotificationInterface $adminnotification,
      UserInterface $userInterface,
      CoursInterface $coursinterface

   ) {

      $this->userrepository = $userInterface;
      $this->coursrepository = $coursinterface;
      $this->adminnotification = $adminnotification;
      $this->coursfeerepository = $coursfee;
   }

   public  function index()
   {
      $new_order_registeration =   $this->adminnotification->get_register_notification();
      //   $new_order_registeration = 
      $low_stoc =   $this->adminnotification->low_stock();
      //  $notification->groupBy('order_type');
      return view('admin.notification.index', compact('new_order_registeration', 'low_stoc'));
   }

   public  function new_register()
   {
      try {
         $new_order_registeration =   $this->adminnotification->get_register_notification();
         return view('admin.notification.new-registration', compact('new_order_registeration'));
      } catch (\Throwable $th) {
         throw $th;
         toastr()->error(__('site.you have error'));
         return redirect()->back();
      }
   }

   public  function user_info_with_cours($order_id)
   {

      try {
         $order = NotificationAdmin::find($order_id);
         $user = $this->userrepository->get_user_by_id($order['user_id']);
         $cours_info = $this->coursrepository->is_defined($order['order_id']);
         if ($order && $user && $cours_info) {

            $user_info = [
               'id'    => $user['id'],
               'img_profile'      => photos_dir($user['photo']),
               'full_name'    => $user['name'],
               'user_mail'    => $user['email'],
               'user_Phone'     => $user['phonenumber']
            ];

            $cours_details = [
               'start_date' => $cours_info['act_StartDa'],
               'end_date' => $cours_info['act_EndDa'],
               'days' => $cours_info['days'],
               'teacher_name' => $cours_info->teacher_name['name'],
               'grade' => $cours_info->category_grade_level['grade']['grade'],
               'level' => $cours_info->category_grade_level['level']['level'],

            ];



            $cours_fee = $this->coursfeerepository->cours_fee_with_type($cours_info);
            $total_cours_fee = $cours_fee->sum('value');
            $this->adminnotification->reading_notification([$order->id]);
            $teach_type = $order->getTeachType();
            return view('admin.notification.sub-blade.user-information', compact('user_info', 'cours_details', 'cours_fee', 'total_cours_fee', 'order_id', 'teach_type'));
         }
      } catch (\Throwable $th) {
         throw $th;
         return response()->json([
            'status' => 'error',
            'user_info'          => "",
            'cours_details'      => "",
            'cours_fee'          => "",
            'total_cours_fee'    => "",
            'order_id'           => "",
         ]);
      }
   }
   public  function low_stock_details($order_id)
   {

      try {

         $notification = NotificationAdmin::find($order_id);
       
         if ($notification->count() > 0) {
            $service = Service::find($notification->order_id);
            $service->currency;

            // return $service;
            return view('admin.notification.sub-blade.low-stock', compact('service', 'notification'));
         }else {
            $service=null;
            $notification=null;
            return view('admin.notification.sub-blade.low-stock', compact('service', 'notification'));
         }
      } catch (\Throwable $th) {
         throw $th;
         return response()->json([
            'status' => 'error',
            'user_info'          => "",
            'cours_details'      => "",
            'cours_fee'          => "",
            'total_cours_fee'    => "",
            'order_id'           => "",
         ]);
      }
   }





   public  function delete_marked(Request $request)
   {


      try {
         DB::beginTransaction();
         $deleted = $this->adminnotification->delete_notification($request->order_id);
         if ($deleted == true) {
            $status = 'success';
            $message = __('site.notifications deleted');
         } else {
            $status = 'error';
            $message = __('site.notifications not deleted');
         }
         DB::commit();
         return response()->json(['status' => $status, 'message' => $message]);
      } catch (\Throwable $th) {
         DB::rollback();
         // throw $th;
         $status = 'error';
         $message = __('site.you site.you have error');
         return response()->json(['status' => $status, 'message' => $message]);
      }
   }

   public function deny_marked(Request $request)
   {
      try {
         DB::beginTransaction();
         $deleted = $this->adminnotification->deny_all_notification($request->order_id);
         if ($deleted == true) {
            $status = 'success';
            $message = __('site.notifications deny');
         } else {
            $status = 'error';
            $message = __('site.you have error');
         }
         DB::commit();
         return response()->json(['status' => $status, 'message' => $message]);
      } catch (\Throwable $th) {
         DB::rollback();
         // throw $th;
         $status = 'error';
         $message = __('site.you site.you have error');
         return response()->json(['status' => $status, 'message' => $message]);
      }
   }


   public function read_marked(Request $request)
   {

      try {
         //code...
         DB::beginTransaction();
         $mark_as_read = $this->adminnotification->reading_notification($request->order_id);
         if ($mark_as_read == true) {
            $status = 'success';
            $message = __('site.mark all as read');
         } else {
            $status = 'error';
            $message = __('site.fail mark all as read');
         }
         DB::commit();
         return response()->json(['status' => $status, 'message' => $message]);
      } catch (\Throwable $th) {
         DB::rollback();
         // throw $th;
         $status = 'error';
         $message = __('site.you site.you have error');
         return response()->json(['status' => $status, 'message' => $message]);
      }
   }

   public function approve_marked(Request $request)
   {
   }
}
