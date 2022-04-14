<?php
/**
 * Created by PhpStorm.
 * User: Hassan
 * Date: 4/12/2022
 * Time: 12:34 PM
 */

namespace App\Repository\Fee_Type;


use App\Models\Fee_type;

class Fee_typeRepository implements Fee_TypeInterface
{

    public function get_all()
    {
        // TODO: Implement get_all() method.

        return Fee_type::select()->get();
    }
}