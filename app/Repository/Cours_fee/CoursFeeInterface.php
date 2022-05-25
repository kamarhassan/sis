<?php
/**
 * Created by PhpStorm.
 * User: Hassan
 * Date: 4/14/2022
 * Time: 4:55 PM
 */

namespace App\Repository\Cours_fee;


interface CoursFeeInterface
{
    public function is_fee_defined($id);
    public function create($request, $cours_id, $currency);
    public function update_fee_cours($request, $cours_id, $currency);
}
