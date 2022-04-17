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

}// end of class
