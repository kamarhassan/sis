<?php

namespace App\Repository\RegisterCours;

use App\Models\Cours;
use App\Models\User;
use App\Models\Sponsor;
use App\Models\NotificationAdmin;
use App\Models\StudentsRegistration;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class RegisterCoursRepository implements RegisterCoursInterface
{

   public function register_in_cours($request)
   {
      $reserveCours = NotificationAdmin::create([
         'user_id' => $request->user_id,
         'order_id' => $request->order_id,
         'order_type' => 'registration',
         'teach_type' => $request->teach_type,
         'description' => __('site.you have a new registration')
      ]);
      return $reserveCours;
   }

   public function delete_register_in_cours($request)
   {
      $reserve = NotificationAdmin::find($request);
      if (!$reserve)
         return false;
      return $reserve->delete();
   }

   public function user_cours_reserved($user_id)
   {
      $user = User::find($user_id);
      if ($user->count() > 0)
         $reserved_courss = NotificationAdmin::where('user_id', $user->id)->get();

      $reserved_courss->each(function ($served_cours) {
       $cours =   Cours::find($served_cours['order_id'])->first();
         $served_cours->category = $cours->category_grade_level;
         return $served_cours;
      });
      return  $reserved_courss;
   }

   public function registration_user_in_cours($request, $cours_fee_total, $sponsorshipid)
   {
      $teams_info = null;
      $request->teams_user != null ? $teams_info = ['username' => $request->teams_user/*, 'password' => Crypt::encryptString($request->teams_pas)*/] : $teams_info = null;
      $sponsorship_id = '';
      if ($request->it_has_discount == 'with_discount') {
         $sponsorship_id = $sponsorshipid;
      }
      try {
         $succes_std_regi = StudentsRegistration::create([
            'user_id' => $request->user_id,
            'cours_id' => $request->cours_id,
            'notes' => $request->fee_note,
            'feesRequired' => $request->feerequired,
            'cours_fee_total' => $cours_fee_total,
            'teams_info' => $teams_info,
            'registration_type' => $request->teach_type,
            'remaining' => $cours_fee_total,
            'sponsorship_id' => $sponsorship_id,
         ]);

         if ($succes_std_regi) {
            return $succes_std_regi;
         } else return false;
      } catch (\Throwable $th) {
         throw $th;
      }
   }

   public function edit_registration_user_in_cours($request, $cours_fee_total, $sponsorshipid, $std_registration_id)
   {
      $teams_info = null;
      $request->teams_user != null ? $teams_info = ['username' => $request->teams_user/*, 'password' => Crypt::encryptString($request->teams_pas)*/] : $teams_info = null;
      $sponsorship_id = '';
      if ($request->it_has_discount == 'with_discount') {
         $sponsorship_id = $sponsorshipid;
      }
      try {
         $student_registartion = StudentsRegistration::find($std_registration_id);
         $succes_std_regi = $student_registartion->update([
            'user_id' => $request->user_id,
            'cours_id' => $request->cours_id,
            'notes' => $request->fee_note,
            'feesRequired' => $request->feerequired,
            'cours_fee_total' => $cours_fee_total,
            'teams_info' => $teams_info,
            'registration_type' => $request->teach_type,
            'remaining' => $cours_fee_total,
            'sponsorship_id' => $sponsorship_id,
         ]);

         if ($succes_std_regi) {
            return $student_registartion;
         } else return false;
      } catch (\Throwable $th) {
         throw $th;
      }
   }
}
