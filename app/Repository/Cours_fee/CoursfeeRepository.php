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
                'value' => (float)$requests,
                'fee_types_id' => $key,
                'currencies_id' => $currency,
                'cours_id' => $cours_id,
            ]);
        }
        return $saved;
    }

    public function is_fee_defined($id)
    {
        $coursfee = CoursFee::where('cours_id', '=', $id)
        ->join('fee_types', 'fee_types_id', 'fee_types.id')
        ->join('currencies', 'currencies_id', 'currencies.id')
        ->select('value','fee_types_id','fee','sponsored','currencies_id','currency','symbol')
        ->get();
        if (!$coursfee)  return false;
        return $coursfee;

    }
}
