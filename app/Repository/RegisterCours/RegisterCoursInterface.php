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

    public function register_in_cours($request,$user_id);
    public function delete_register_in_cours($request,$user_id);
 
}
