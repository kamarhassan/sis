<?php
/**
 * Created by PhpStorm.
 * User: Hassan
 * Date: 4/12/2022
 * Time: 12:32 PM
 */

namespace App\Repository\Fee_Type;


interface Fee_TypeInterface
{
    public function get_all();
    public function fee_type_id();
    public function store_fee_type($request);
    public function it_is_used($fee_types_id);

}
