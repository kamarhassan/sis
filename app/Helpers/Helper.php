<?php

use App\Models\ContactUs;
use App\Models\User;
use App\Models\Language;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\NotificationAdmin;
use App\Models\StudentsRegistration;
use Illuminate\Support\Facades\Config;
use App\Repository\Cours\CoursRepository;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Repository\AdminNotification\AdminNotificationRepository;



function  logo()
{
   // if ($photoUrl != "")
   //    return  URL::asset($photoUrl);
   // else   return URL::asset('assets\images\avatar\avatar-1.png');

   return URL::asset('public/files/logo.jfif');
}

function show_real_pass($hash_password)
{

   try {
      return  decrypt($hash_password);
   } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
   }
}

function pagination_count()
{
   return 1000;
}

function encript_custome($id)
{
   return encrypt($id);
}

function slider_width()
{
   // return;
   return 1920;
}
function slider_height()
{
   // return;
   return 600;
}
function days_of_week()
{
   return [
      1 => __('site.monday'),
      2 => __('site.tuesday'),
      3 => __('site.wednesday'),
      4 => __('site.thursday'),
      5 => __('site.friday'),
      6 => __('site.saturday'),
   ];
}

function day_of_week_for_cours($array)
{
   //  return Cours::select('days')->get();
   return explode(";", $array);
}

function current_school_year()
{

   // return  [
   //    'start' =>  '2022-09-01',
   //    'end' =>   '2023-09-01',
   //    'year' => '2022-2023'
   // ];



   return  [
      'start' => Session::get('start schoolyear'),
      'end' =>  Session::get('end schoolyear'),
      'year' =>  Session::get('schoolyear')
   ];
}

function last_school_year()
{
   //   $year= App\Models\Years::latest()->first();
   $year = App\Models\Years::where('currentyear', 1)->first();
   return $year;
}


function get_active_Language()
{
   return Language::active()->selection()->get();
}


function get_Default_language()
{
   return  Config::get('app.locale');
}

function uploadimage($folder, $image)
{
   $image->store('/', $folder);
   $filename = $image->hashName();
   $path = 'images/' . $folder . '/' . $filename;
   return $path;
}

// function getprefix(){
//     return  Request::route()->getPrefix();
//     // return  Request::getprefix;
// }
function routename()
{
   return     Route::currentRouteName();
}


function getprefix($prefix)
{
   return  LaravelLocalization::setLocale() . '/admin/' . $prefix;
}


function  swal_fire_msg()
{

   return [
      'title' => __('site.title_of_delet_swal_fire'),
      'text_of_delet' => __('site.text_of_delet_swal_fire'),
      'confirmButtonTextof' => __('site.confirmButtonTextof_delet_swal_fire'),
      'cancelButton' => __('site.cancelButtonTextof_delet_swal_fire'),
      'deleted_msg' => __('site.deleted_msg_swal_fire'),
      'succes_msj' => __('site.succes_msj_swal_fire'),
      'failed_delete' => __('site.failed_delete'),
      'not_any_selection' => __('site.select_at_least_one_to_delete'),
   ];
}



function  attendance_swal_fire_msg()
{
   return [
      'title' => __('site.title_of_delet_swal_fire_attendance'),
      'text_of_delet' => __('site.text_of_delet_swal_fire'),
      'confirmButtonTextof' => __('site.confirmButtonTextof_delet_swal_fire'),
      'cancelButton' => __('site.cancelButtonTextof_delet_swal_fire'),
      'deleted_msg' => __('site.deleted_msg_swal_fire'),
      'succes_msj' => __('site.succes_msj_swal_fire'),
      'failed_delete' => __('site.failed_delete'),
      'not_any_selection' => __('site.select_at_least_one_to_delete'),
   ];
}




function  swal_fire_msg_school_years()
{

   return [
      'title' => __('site.school year'),
      'text_of_confirmation_change' => __('site.confirme change cant change after this'),
      'confirmButtonTextof' => __('site.confirmButtonTextof_change_swal_fire'),
      'cancelButton' => __('site.cancelButtonTextof_delet_swal_fire'),
      'changed_msg' => __('site.changed_msg_swal_fire'),
      'succes_msj' => __('site.succes_change_msj_swal_fire'),
      'failed_change' => __('site.failed change'),
      'not_any_selection' => __('site.select_at_least_one_to_delete'),
   ];
}


function  photos_dir($photoUrl)
{
   if ($photoUrl != "")
      return  URL::asset($photoUrl);
   else   return URL::asset('assets\images\avatar\avatar-1.png');
}

function array_to_string($array, $caratcter_implode)
{
   $string = implode($caratcter_implode, $array);
   return $string;
}

function string_to_array($string)
{

   return explode(";", $string);
}

function get_count_notification()
{
   $count_notification = new  AdminNotificationRepository();
   $contact_us = new ContactUs();
   $notification = new  NotificationAdmin();
   return   $count_notification->get_all_unread_notification($notification)->count() + $count_notification->get_all_unread_notification($contact_us)->count();
}

function get_type_notification()
{
   $type_id_description = new  AdminNotificationRepository();
   $contact_us = \App\Models\ContactUs::get();
   $notification = new  NotificationAdmin();
   return   ['type_id_description' => $type_id_description->get_type_id_description($notification), 'contact_us' => $contact_us];
}



function certifcate_variable()
{
   return [
      "{{\$user_id}}",
      "{{\$name}}",
      "{{\$email}}",
      "{{\$mark}}",
      "{{\$birthdate}}",
      "{{\$place_of_birth}}",
      "{{\$grade}}",
      "{{\$level}}",
      "{{\$class_start_date}}",
      "{{\$class_end_date}}",
      "{{\$print_date}}",
      // institute infromation
      // "{{\$institute_name}}",
      // "{{\$institute_phone}}",
      // "{{\$institute_email}}",
      // "{{\$institute_city}}",
      // "{{\$institute_building}}",
      // "{{\$institute_class_end_date}}",

   ];
}
if (!function_exists('hasDynamicPage')) {
   function hasDynamicPage()
   {

      return true;
   }
}


if (!function_exists('assetVersion')) {
   function assetVersion()
   {
      if (config('app.debug')) {
         $ver = rand(1, 9999);
      } else {
         $ver = Storage::has('.version') ? Storage::get('.version') : Settings('system_version');
      }
      return '?v=' . 1;
   }
}


if (!function_exists('logo')) {
   function logo()
   {

      return URL::asset('assets/images/favicon.ico');
   }
}
