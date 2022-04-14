<?php

/**
 * Created by PhpStorm.
 * User: Hassan
 * Date: 4/14/2022
 * Time: 4:57 PM
 */

namespace App\Repository\Cours_fee;

use App\Models\CoursFee;
use PhpParser\Node\Expr\Cast\Double;
use PhpParser\Node\Stmt\Foreach_;

class CoursfeeRepository implements CoursfeeInterface
{

    public function create($request, $cours_id, $currency)
    {
        // TODO: Implement create() method.
        // $cours_fee = [];
        // return $request;
        foreach ($request as $key => $requests) {
            $saved = CoursFee::create([
                'value'=>(Double)$requests,
                'fee_types_id'=>$key,
                'currencies_id'=>$currency,
                'cours_id'=> $cours_id,
            ]);
        }
        return $saved;
    }
}
