<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditRegistrationRequest;
use App\Http\Requests\NewRegistrationStydentsRequest;
use App\Models\Admin;
use App\Models\NotificationAdmin;
use App\Models\Payment;
use App\Models\Sponsor;
use App\Models\SponsorType;
use App\Models\StudentsRegistration;
use App\Models\User;
use App\Repository\AdminNotification\AdminNotificationInterface;
use App\Repository\Cours\CoursInterface;
use App\Repository\Cours_fee\CoursFeeInterface;
use App\Repository\RegisterCours\RegisterCoursInterface;
use App\Repository\SponsoreShip\SponsoreShipsInterface;
use App\Repository\User\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class RegistartionStudentsController extends Controller
{
   protected $userrepository;
   protected $coursrepository;
   protected $coursfeerepository;
   protected $registerCoursrepository;
   protected $adminnotoficationrepository;
   protected $sponsoreshipsrepository;

   public function __construct(
      UserInterface $userinterface,
      CoursInterface $coursinterface,
      CoursFeeInterface $coursfee,
      RegisterCoursInterface $registerCours,
      AdminNotificationInterface $adminnotofication,
      SponsoreShipsInterface $sponsoreships
   )
   {
      $this->userrepository = $userinterface;
      $this->coursrepository = $coursinterface;
      $this->coursfeerepository = $coursfee;
      $this->registerCoursrepository = $registerCours;
      $this->adminnotoficationrepository = $adminnotofication;
      $this->sponsoreshipsrepository = $sponsoreships;
   }

   public function approve_user_register(Request $request)
   {

      try {
         //code...
         // return $request;
         DB::beginTransaction();

         $user_info = $this->userrepository->get_user_by_id($request->user_id);
         $cours_fee_currency = $this->coursrepository->cours_fee_currency($request->cours_id);
         $cours_info = $this->coursrepository->is_defined($request->cours_id);
         $grade = $cours_info->grade;
         $level = $cours_info->level;
         $cours_fee = $this->coursfeerepository->cours_fee_with_type($cours_info);
         $total_cours_fee = $cours_fee->sum('value');
         $route = route('admin.notification.approve.edit.register');
         DB::commit();

         return response()->json([
            'status' => 'success',
            'user_info' => $user_info,
            'cours_details' => $cours_info,
            'cours_fee' => $cours_fee,
            'total_cours_fee' => $total_cours_fee,
            'cours_fee_currency' => $cours_fee_currency,
            'route' => $route,
         ]);
      } catch (\Throwable $th) {
         DB::rollback();
         // throw $th;

         return response()->json([
            'status' => 'error',
            // 'user_info' => $user_info,
            // 'cours_details' => $cours_info,
            // 'cours_fee' => $cours_fee,
            // 'total_cours_fee' => $total_cours_fee,         
         ]);
      }
   }

   public function new_register($cours_id_, $user_id_)
   {

      try {
         //code...
         DB::beginTransaction();

         $user_id = decrypt($user_id_);
         $cours_id = decrypt($cours_id_);
         $user_info = $this->userrepository->get_user_by_id($user_id);

         $cours_info = $this->coursrepository->is_defined($cours_id);
         if ($cours_info) {
            $cours_fee_currency = $this->coursrepository->cours_fee_currency($cours_info->currencies_id);
            if ($cours_fee_currency == false) {
               toastr()->error(__('site.fee of this cours note defined'));
               return redirect()->route('admin.students.Registration-1');
            }
            $cours_info->category_grade_level;
            $cours_info;
            $cours_fee = $this->coursfeerepository->cours_fee_with_type($cours_info);
            $teachear_name = $this->coursrepository->cours_theacher_name($cours_info);
            $total_cours_fee = $cours_fee->sum('value');
            $sponsor = Sponsor::get(['id', 'name']);
            $sponsore_fee_types = SponsorType::get();

            return view('admin.students.approve-registration.approve-registration',
               compact(['user_info', 'cours_info', 'cours_fee', 'cours_fee_currency', 'total_cours_fee', 'sponsor', 'sponsore_fee_types']));
         }
      } catch (\Throwable $th) {
         DB::rollback();
         throw $th;
      }
   }


   public function approve_edit_register(Request $request)
   {

      try {
         // return $request;

         $user_info = $this->userrepository->get_user_by_id($request->user_id);
         // $t = $user_info['teams_info']['password'];
         // dd(Crypt::decryptString($t));
         //   $user_info['teams_info']['password'] = Crypt::decryptString($user_info['teams_info']['password']);
         $notification = NotificationAdmin::find($request->cours_id);
         $teach_type = ['key' => $notification->teach_type, 'type' => $notification->getTeachType()];
         $cours_info = $this->coursrepository->is_defined($notification->order_id);

         $cours_fee_currency = $this->coursrepository->cours_fee_currency($cours_info->currencies_id);
         if ($cours_fee_currency == false) {
            toastr()->error(__('site.fee of this cours note defined'));
            //         return abort(404);
            //         toastr()->success(__('site.login succes'));
            return redirect()->back();
         }
         $grade = $cours_info->grade;
         $level = $cours_info->level;
         $cours_fee = $this->coursfeerepository->cours_fee_with_type($cours_info);
         $teachear_name = $this->coursrepository->cours_theacher_name($cours_info);
         $total_cours_fee = $cours_fee->sum('value');

         $this->adminnotoficationrepository->approve_all_notification($request->order_id);
         $sponsor = Sponsor::get(['id', 'name']);

         return view(
            'admin.students.approve-registration.approve-registration',
            compact([
               'user_info', 'cours_info', 'cours_fee', 'cours_fee_currency', 'total_cours_fee', 'sponsor', 'teach_type'
            ])
         );
      } catch (\Throwable $th) {
         throw $th;
      }
   }

   public function approved_new_register(NewRegistrationStydentsRequest $request)
   {

      try {
         // return $request;
         DB::beginTransaction();

         /**
          *  edit RegistrationStudentsRequest
          *  1  - if has discount check of required field same discount percentage sponsore , sopser type
          */
         User::find($request->user_id)->update([
            'teams_info' => ['username' => $request->teams_user/*, 'password' => Crypt::encryptString($request->teams_pas)*/]
         ]);

         $feerequired_temp = $this->coursfeerepository->get_fee_required_cours($request->cours_fee);
         $sponsor_ship_id = '';
         if ($request->it_has_discount == 'with_discount') {

            //   return  $sponsor_ship = $this->sponsoreshipsrepository->CreateNewSponsorShip($request->sponsor_id, $request->cours_id, $request->sponsore_fee_type_id, $request->fee_sponsored,$request->fee_sponsored_discount,$request->fee_sponsored_percent, $request->note);
            $sponsor_ship = $this->sponsoreshipsrepository->CreateNewSponsorShip($request->sponsor_id, $request->cours_id, $request->sponsore_fee_type_id, $request->fee_sponsored, $request->fee_sponsored_discount, $request->fee_sponsored_percent, $request->note);
            $request->feerequired = $feerequired = $this->sponsoreshipsrepository->calculate_discount_fee_required($feerequired_temp, $request->fee_sponsored_discount, $request->fee_sponsored_percent);
            $sponsor_ship_id = $sponsor_ship->id;
         } else {
            $request->feerequired = $feerequired = $feerequired_temp;
         }

         $cours_fee_total = array_sum(array_column($feerequired, 'fee_value'));

         $std_registragtion = $this->registerCoursrepository->registration_user_in_cours($request, $cours_fee_total, $sponsor_ship_id);
         $route = route(
            'admin.payment.user_paid_for_cours',
            [$std_registragtion->cours_id, $std_registragtion->user_id]
         );

         DB::commit();
         if ($std_registragtion) {
            $status = 'success';
            $message = __('site.students created successfully!');
         } else {
            $status = 'error';
            $message = __('site.fail created successfully!');
         }
         return response()->json(['status' => $status, 'message' => $message, 'route' => $route]);
      } catch (\Throwable $th) {
         throw $th;
         DB::rollback();
         $status = 'error';
         $message = __('site.you site.you have error');
         return response()->json(['status' => $status, 'message' => $message/*, 'route' => $route*/]);
         // throw $th;
      }
   }

   public function Teacher_register_new_std()
   {
      $admin_logged = Admin::find(Auth::id());

      $cours = $this->coursrepository->cours_of_teacher($admin_logged->id);
      $is_teacher = true;
      // }
      if ($cours->count() == 0) {
         toastr()->error(__('site.you dont have any cours'));
         return redirect()->route('admin.dashborad');
      }
      return view('admin.students.students_registration-by-teahcer.create');
   }

   public function Save_teacher_register_new_std(/*RegistrationStydents*/ Request $request)
   {
      return $request;
   }


   public function get_std_by_searche_to_regisater(Request $request)
   {
   }


   public function delete_std_registration(Request $request)
   {

      $user_id = $request->id['user_id'];
      $cours_id = $request->id['cours_id'];
      $std_registartion = StudentsRegistration::where(['user_id' => $user_id, 'cours_id' => $cours_id])->first();
      $has_payment = Payment::where('studentsRegistration_id', $std_registartion->id)->get()->count();
      if ($has_payment > 0) {

         $message = __('site.can\'t delete because already has payment');
         $status = 'error';
         $id_delete = '';
      } else {

         $std_registartion->delete();
         $message = __('site.can\'t delete because already has payment');
         $status = 'success';
         $id_delete = $user_id;
      }
      return response()->json([
         'message' => $message,
         'status' => $status,
         'id_delete' => $id_delete,
      ]);
   }

   public function edit_registration($user_id, $cours_id)
   {


      $std_registartion = StudentsRegistration::where(['user_id' => $user_id, 'cours_id' => $cours_id])->first();
      $has_payment = Payment::where('studentsRegistration_id', $std_registartion->id)->get()->count();
      if ($has_payment > 0) {

         toastr()->error(__('site.can\'t edit because already has payment'));
         return redirect()->back();
      } else {

         $user_info = $this->userrepository->get_user_by_id($user_id);

         $cours_info = $this->coursrepository->is_defined($cours_id);

         $cours_fee_currency = $this->coursrepository->cours_fee_currency($cours_info->currencies_id);
         if ($cours_fee_currency == false) {
            toastr()->error(__('site.fee of this cours note defined'));
            return redirect()->route('admin.students.Registration-1');
         }
         $cours_info->category_grade_level;

//         $grade = $cours_info->category_grade_level['grade'];
//         $level = $cours_info->category_grade_level['level'];
         $cours_fee = $this->coursfeerepository->cours_fee_with_type($cours_info);
         $teachear_name = $this->coursrepository->cours_theacher_name($cours_info);
         $total_cours_fee = $cours_fee->sum('value');
         $sponsor = Sponsor::get(['id', 'name']);
         $sponsore_fee_types = SponsorType::get();


         return view(
            'admin.students.approve-registration.edit-registration',
            compact('user_info',
               'cours_info', 'cours_fee_currency', 'cours_fee', 'total_cours_fee', 'sponsor', 'sponsore_fee_types', 'std_registartion')
         );
      }
   }


   public function post_edit_registration(EditRegistrationRequest $request)
   {


      try {
         // return $request;
         DB::beginTransaction();

         /**
          *  edit RegistrationStudentsRequest
          *  1  - if has discount check of required field same discount percentage sponsore , sopser type
          */


         //  $std_registration= StudentsRegistration::find($request->std_registartion_id);
         User::find($request->user_id);

         $feerequired_temp = $this->coursfeerepository->get_fee_required_cours($request->cours_fee);
         $sponsor_ship_id = '';
         if ($request->it_has_discount == 'with_discount') {

            //   return  $sponsor_ship = $this->sponsoreshipsrepository->CreateNewSponsorShip($request->sponsor_id, $request->cours_id, $request->sponsore_fee_type_id, $request->fee_sponsored,$request->fee_sponsored_discount,$request->fee_sponsored_percent, $request->note);
            $sponsor_ship = $this->sponsoreshipsrepository->CreateNewSponsorShip($request->sponsor_id, $request->cours_id, $request->sponsore_fee_type_id, $request->fee_sponsored, $request->fee_sponsored_discount, $request->fee_sponsored_percent, $request->note);
            $request->feerequired = $feerequired = $this->sponsoreshipsrepository->calculate_discount_fee_required($feerequired_temp, $request->fee_sponsored_discount, $request->fee_sponsored_percent);
            $sponsor_ship_id = $sponsor_ship->id;
         } else {
            $request->feerequired = $feerequired = $feerequired_temp;
         }

         $cours_fee_total = array_sum(array_column($feerequired, 'fee_value'));

         $std_registragtion = $this->registerCoursrepository->edit_registration_user_in_cours($request, $cours_fee_total, $sponsor_ship_id, $request->std_registartion_id);
         $route = route(
            'admin.payment.user_paid_for_cours',
            [$std_registragtion->cours_id, $std_registragtion->user_id]
         );

         DB::commit();
         if ($std_registragtion) {
            $status = 'success';
            $message = __('site.students created successfully!');
         } else {
            $status = 'error';
            $message = __('site.fail created successfully!');
         }
         return response()->json(['status' => $status, 'message' => $message, 'route' => $route]);
      } catch (\Throwable $th) {
         throw $th;
         DB::rollback();
         $status = 'error';
         $message = __('site.you site.you have error');
         return response()->json(['status' => $status, 'message' => $message/*, 'route' => $route*/]);
         // throw $th;
      }

   }

}
