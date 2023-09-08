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
    public function open_and_postopen_cours($limit = null);
    public function store_cours($REQUEST, $teacher_id);
    public function update_cours($request, $teacher_id, $cours_id);
    public function cours_fee_currency($cours_currency_id);
    public function cours_theacher_name($cours);
    public function cours_of_teacher_with_registartion_students( $teacher_id);
    public function cours_of_teacher_super_admin_loged(array $teacher_id);
    public function cours_for_export();
    public function count_students_in_cours($cours_id);
    public function cours_of_teacher($teacher_id);
    
}
