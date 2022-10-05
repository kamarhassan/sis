<?php

/**
 * Created by PhpStorm.
 * User: Hassan
 * Date: 4/10/2022
 * Time: 1:25 PM
 */

namespace App\Repository\RegisterCours;


interface RegisterCoursInterface
{

    public function registration_user_in_cours($request,$cours_fee_total);
    public function register_in_cours($request);
    public function user_cours_reserved($user_id);
    public function delete_register_in_cours($register_id);
 
}
