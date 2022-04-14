<?php
/**
 * Created by PhpStorm.
 * User: Hassan
 * Date: 4/14/2022
 * Time: 4:55 PM
 */

namespace App\Repository\Cours_fee;


interface CoursfeeInterface
{
public function create($request,$cours_id,$currency);
}
