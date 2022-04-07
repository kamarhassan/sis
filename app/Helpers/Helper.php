<?php

use App\Models\Language;
use Illuminate\Support\Facades\Config;



function pagination_count(){
    return 15;
}


function current_school_year(){
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


function  swal_fire_msg(){

    return [
         __('site.title_of_delet_swal_fire'),
         __('site.text_of_delet_swal_fire'),
         __('site.confirmButtonTextof_delet_swal_fire'),
          __('site.cancelButtonTextof_delet_swal_fire'),
         __('site.deleted_msg_swal_fire'),
         __('site.succes_msj_swal_fire'),

    ];
}
