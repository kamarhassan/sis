<?php


use App\Models\Language;
use App\Models\NotificationAdmin;
use App\Repository\AdminNotification\AdminNotificationRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;






function pagination_count()
{
    return 15;
}

function encript_custome($id)
{
    return encrypt($id);
}

function days_of_week()
{
    return [
        1 => __('site.monday'),
        2 => __('site.tuesday'),
        3 => __('site.wednesday'),
        4 => __('site.thirsday'),
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
    return 2022;
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
       'title'=> __('site.title_of_delet_swal_fire'),
       'text_of_delet'=> __('site.text_of_delet_swal_fire'),
       'confirmButtonTextof'=> __('site.confirmButtonTextof_delet_swal_fire'),
       'cancelButton'=> __('site.cancelButtonTextof_delet_swal_fire'),
       'deleted_msg'=> __('site.deleted_msg_swal_fire'),
       'succes_msj'=> __('site.succes_msj_swal_fire'),
       'failed_delete'=> __('site.failed_delete'),
       'not_any_selection'=> __('site.select_at_least_one_to_delete'),
    ];
}
function  photos_dir($photoUrl)
{
    if ($photoUrl != "")
        return  URL::asset($photoUrl);
    else   return URL::asset('assets\images\avatar\avatar-1.png');


    // assets\images\avatar\avatar-1.png
}

function array_to_string($array)
{
    $string = implode(";", $array);
    return $string;
}

function string_to_array($string)
{

    return explode(";", $string);
}

function get_count_notification()
{
    $count_notification = new  AdminNotificationRepository();
    return   $count_notification->get_all_unread_notification()->count();
}

function get_type_notification()
{
    $type_id_description = new  AdminNotificationRepository();
    return   $type_id_description->get_type_id_description();
}



// @php
//     $admin_notificatio = \App\Mpdels\NotificationAdmin::query()->where('delete',0)
//     ->andwhere('status',0)->get();
//     dd($admin_notificatio);
// @endphp