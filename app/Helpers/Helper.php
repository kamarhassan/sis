<?php


use App\Models\Language;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;


function pagination_count()
{
    return 15;
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
        __('site.title_of_delet_swal_fire'),
        __('site.text_of_delet_swal_fire'),
        __('site.confirmButtonTextof_delet_swal_fire'),
        __('site.cancelButtonTextof_delet_swal_fire'),
        __('site.deleted_msg_swal_fire'),
        __('site.succes_msj_swal_fire'),

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


// function theme_mode()
// {
//     if ($mode == "dark-skin")
//         return "light-skin";

//     return "dark-skin";
// }





// function test_nb_stq(float $number)
// {
//     $decimal = round($number - ($no = floor($number)), 2) * 100;
//     $hundred = null;
//     $digits_length = strlen($no);
//     $i = 0;
//     $str = array();
//     $words = array(
//         0 => '',
//         1 => __('Nb_to_Word.one'),
//         2 => __('Nb_to_Word.two'),
//         3 => __('Nb_to_Word.three'),
//         4 => __('Nb_to_Word.four'),
//         5 => __('Nb_to_Word.five'),
//         6 => __('Nb_to_Word.six'),
//         7 => __('Nb_to_Word.seven'),
//         8 => __('Nb_to_Word.eight'),
//         9 => __('Nb_to_Word.nine'),
//         10 => __('Nb_to_Word.ten'),
//         11 => __('Nb_to_Word.eleven'),
//         12 => __('Nb_to_Word.twelve'),
//         13 => __('Nb_to_Word.thirteen'),
//         14 => __('Nb_to_Word.fourteen'),
//         15 => __('Nb_to_Word.fifteen'),
//         16 => __('Nb_to_Word.sixteen'),
//         17 => __('Nb_to_Word.seventeen'),
//         18 => __('Nb_to_Word.eighteen'),
//         19 => __('Nb_to_Word.nineteen'),
//         20 => __('Nb_to_Word.twenty'),
//         30 => __('Nb_to_Word.thirty'),
//         40 => __('Nb_to_Word.forty'),
//         50 => __('Nb_to_Word.fifty'),
//         60 => __('Nb_to_Word.sixty'),
//         70 => __('Nb_to_Word.seventy'),
//         80 => __('Nb_to_Word.eighty'),
//         90 => __('Nb_to_Word.ninety')
//     );
//     $digits = array('', __('Nb_to_Word.hundred'), __('Nb_to_Word.thousand'), __('Nb_to_Word.lakh'), __('Nb_to_Word.crore'));
//     while ($i < $digits_length) {
//         $divider = ($i == 2) ? 10 : 100;
//         $number = floor($no % $divider);
//         $no = floor($no / $divider);
//         $i += $divider == 10 ? 1 : 2;
//         if ($number) {
//             $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
//             $hundred = ($counter == 1 && $str[0]) ? __('Nb_to_Word.and') : null;
//             $str[] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural . ' ' . $hundred : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
//         } else $str[] = null;
//     }
//     $Rupees = implode('', array_reverse($str));
//     $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
//     return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
// }
