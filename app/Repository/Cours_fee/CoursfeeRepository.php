<?php


namespace App\Repository\Cours_fee;

// use App\Models\CoursFee;
use App\Models\CoursFee;
use PhpParser\Node\Stmt\Foreach_;
use PhpParser\Node\Expr\Cast\Double;

class CoursfeeRepository implements CoursFeeInterface
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
            ->select('value', 'fee_types_id', 'fee', 'sponsored', 'currencies_id', 'currency', 'symbol')
            ->get();
        if (!$coursfee)  return false;
        return $coursfee;
    }
    public function update_fee_cours($request, $cours_id, $currency)
    {
        $cours_fee =  CoursFee::Where('cours_id', $cours_id)->getOrFail();
        if (!$cours_fee) {
            $saved = $this->create($request, $cours_id, $currency);
            return $saved;
        } else {
            //
            foreach ($cours_fee as $key => $cours_fees) {
                $cours_fee[$key]->delete();
            }
            $saved = $this->create($request, $cours_id, $currency);
            return $saved;
        }
    }


    public function cours_fee_with_type($cours)
    {
        if (!$cours)
            return false;
        return  $fee = $cours->fee_with_type;
    }
    public function cours_fee_with_type_and_currency($cours)
    {
        if (!$cours)
            return false;
        return  $fee = $cours->fee_with_type_currency;
    }
}
