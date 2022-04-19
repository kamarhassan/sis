<?php
/**
 * Created by PhpStorm.
 * User: Hassan
 * Date: 4/12/2022
 * Time: 12:32 PM
 */

namespace App\Repository\Students;


interface StudentsInterface
{
    public function get_std_cours($id,$slection);
    // public function fee_type_id();

}
