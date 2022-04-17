<?php

/**
 * Created by PhpStorm.
 * User: Hassan
 * Date: 4/10/2022
 * Time: 1:25 PM
 */

namespace App\Repository\Admin;


interface AdminInterface
{

    public function GetTeacherIDbyName($id);

    // public function all_cours();
    // public function  edit_cours($request, $teacher_id);
    // public function store_cours($REQUEST, $teacher_id);
}
