<?php

/**
 * Created by PhpStorm.
 * User: Hassan
 * Date: 4/12/2022
 * Time: 12:34 PM
 */

namespace App\Repository\Students;

use Validator;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Cours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Repository\Students\StudentsInterface;

class StudentsRepository implements StudentsInterface
{
    public function get_std_cours($id, $slection)
    {

        $cours = Cours::With(['students' => function ($query) {
            $query->select('users.id', 'users.name', 'users.created_at');
        }])->find($id);
        return  $cours;
    }


    public function students_only()
    {
        return User::students();
    }

    public function students_for_cours_defined($cours_id)
    {

        $cours = Cours::find($cours_id);
        if (!$cours) {
            return false;
        }
        $collection = $cours->students;
        return     $sorted = $collection->sortBy([
            ['name', 'asc'],

        ]);
    }


    public function prepare_students_to_import($array_students_imported)
    {
        // return 1;
        $all_row_null = $array_students_imported
            /**get all empty row and remove from excel */
            ->whereNull('0', '!=', null)
            ->whereNull('1', '!=', null)
            ->whereNull('2', '!=', null)
            ->whereNull('3', '!=', null)
            ->whereNull('4', '!=', null)
            ->whereNull('5', '!=', null)
            ->whereNull('6', '!=', null)
            ->whereNull('7', '!=', null)
            ->whereNull('8', '!=', null)
            ->whereNull('9', '!=', null)
            ->whereNull('10', '!=', null);


        /**students only  without empty row*/
        $all_students =  $array_students_imported->diff($all_row_null);
        //    $all_students = $all_students_;
        // return response()->json($all_students);

        /**filter data to remove row if has an erroe in one of field example one field is null it remove this row */

        $filtered = $all_students
            ->whereNotNull('0', '!=', null)
            ->whereNotNull('1', '!=', null)
            ->whereNotNull('2', '!=', null)
            ->whereNotNull('3', '!=', null)
            ->whereNotNull('4', '!=', null)
            ->whereNotNull('5', '!=', null)
            ->whereNotNull('6', '!=', null)
            ->whereNotNull('7', '!=', null)
            ->whereNotNull('8', '!=', null)
            ->whereNotNull('9', '!=', null)
            ->whereNotNull('10', '!=', null);

        $user_data = $filtered->all();



        /**filter data to get the  row if has an erroe in one of field example one field is null it remove this row */

        $user_data_error =  $all_students->diff($user_data);

        array_shift($user_data);
        return [
            'user_data_error' => $user_data_error,
            'user_data' => $user_data,
            'all_students' => $all_students
        ];
    }

    public function vaidate_students_to_import($array_students_validate_befor_import)
    {
        $rules = [
            'segel'             => ['required', 'numeric'],
            'segel_place'       => ['required'],
            'birthday_place'    => ['required'],
            'name'              => ['required'],
            'birthday'          => ['required', 'date'],
            'firstname'         => ['required', 'string', 'max:255'],
            'midname'           => ['required', 'string', 'max:255'],
            'lastname'          => ['required', 'string', 'max:255'],
            'phonenumber'       => ['required', 'digits:8', 'numeric'],
            'email'             => ['required', 'string', 'email', 'max:255'],
        ];

        $msg = [

            'segel.required'             => __('site.import sejel is not valid'),
            'segel.numeric'              => __('site.import sejel is not valid'),

            'segel_place.required'       => __('site.import sejel place is not valid'),
            'birthday_place.required'    => __('site.import birthday place is not valid'),
           
            'birthday.required'          => __('site.import date not valide'),
            'birthday.date'              => __('site.import date not valide'),
           
            'firstname.required'         => __('site.import firstname is not valid'),
            'midname.required'           => __('site.import midname is not valid'),
            'lastname.required'          => __('site.import lastname is not valid'),

            'email.required'             => __('site.import email is not valid'),
            'email.email'                => __('site.import email is not valid'),

            'phonenumber.required'       => __('site.import phonenumber is not valid'),
            'phonenumber.digits'         => __('site.import phonenumber is not valid'),
            'phonenumber.numeric'        => __('site.import phonenumber is not valid'),

            // 'import sejel is not valid' => 'رقم السجل غير صحيح',
            // 'import sejel place is not valid' => 'البلدة / مكان السجل غير صحيح',
            // 'import birthday place is not valid'   => 'مكان الولادة غير صحيح',
            // 'import date not valide' => 'تاريخ الميلاد غير صحيح',
            // 'import firstname is not valid' => 'الاسم الاول غير صحيح',
            // 'import midname is not valid' =>  'الاسم الاب غير صحيح',
            // 'import lastname is not valid' =>  'الشهرة غير صحيح',
            // 'import phonenumber is not valid' =>  'رقم الهاتف غير صحيح',
            // 'import email is not valid'     => 'البريد الالكتروني غير صحيح',



        ];


        $is_valide_ = [];
        $user_data_valide = [];
        $user_data_not_valide = [];
        $keyword = [];
        $i = -1;
        foreach ($array_students_validate_befor_import as $key => $value) {
            $keyword[] = $key + 1;
            $i++;
            $data = new Request([
                'segel'             => $value[0],
                'segel_place'       => $value[1], //badel segel place id
                'birthday_place'    => $value[2], //badel segel place id
                'birthday'          => $value[5] . '/' . $value[4] . '/' . $value[3],
                'phonenumber'       => $value[6],
                'email'             => $value[7],
                'lastname'          => $value[8],
                'midname'           => $value[9],
                'firstname'         => $value[10],
                'name'              => $value[10] . " " . $value[9]  . " " . $value[8],
                'password'          => Hash::make('1234'),
                'email_verified_at' => Carbon::now()

            ]);
            $validator = Validator::make($data->all(), $rules, $msg);
            $is_valide_[] = $validator->fails();
            if ($validator->fails()) {
                // if ($i != 0)
                $user_data_not_valide[] = [
                    'index' => $key + 1,
                    // 'type' => date('m-d-yy', $value[3]),
                    'user_data_error' => $value,
                    'error' =>  $validator->errors(),
                ];
            } else {
                $user_data_valide[] = $data->all();
                # code...
            }
        }
        return  [
            // 'keyword' => $keyword,
            'user_data_not_valide' => $user_data_not_valide,
            'user_data_valide' => $user_data_valide
        ];
    }


    public function traitement_user_error_to_export($array_students_error){

        $user_error=[];
        foreach ($array_students_error as $key => $value) {
           $user_error[]=$value['user_data_error'];
        }

        return $user_error;
    }
}
