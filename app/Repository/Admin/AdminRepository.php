<?php

/**
 * Created by PhpStorm.
 * User: Hassan
 * Date: 4/10/2022
 * Time: 1:23 PM
 */

namespace App\Repository\Admin;

use App\Models\Grade;
use App\Models\level;

use App\Models\Admin;
use App\Repository\Admin\AdminInterface;

class AdminRepository implements AdminInterface
{
    public function  GetTeacherIDbyName($id)
    {
        return   Admin::GetIdByName($id);
    }
    public function  all_teacher_id()
    {
        return   Admin::role('teacher')->get('id')->toArray();
    }
   
}// end of class
