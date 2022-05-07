<?php

/**
 * Created by PhpStorm.
 * User: Hassan
 * Date: 4/12/2022
 * Time: 12:34 PM
 */

namespace App\Repository\Students;

use App\Models\User;
use App\Models\Cours;
use App\Repository\Students\StudentsInterface;

class StudentsRepository implements StudentsInterface
{
    public function get_std_cours($id,$slection)
    {

        $cours = Cours::With(['students'=> function ($query) {
            $query->select('users.id','users.name','users.created_at');
        }])->find($id);
        return  $cours;
    }


    public function students_only(){
        return User::students();
    }
}
