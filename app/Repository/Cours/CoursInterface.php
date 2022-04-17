<?php

/**
 * Created by PhpStorm.
 * User: Hassan
 * Date: 4/10/2022
 * Time: 1:25 PM
 */

namespace App\Repository\Cours;


interface CoursInterface
{

    public function is_defined($id);
    public function all_cours();
    public function store_cours($REQUEST, $teacher_id);
    public function update_cours($request, $teacher_id,$cours_id);
}
