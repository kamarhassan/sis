<?php

/**
 * Created by PhpStorm.
 * User: Hassan
 * Date: 4/12/2022
 * Time: 12:34 PM
 */

namespace App\Repository\Fee_Type;

use App\Models\CoursFee;
use Carbon\Carbon;
use App\Models\Fee_type;
use Illuminate\Support\Facades\DB;

class Fee_typeRepository implements Fee_TypeInterface
{

    public function get_all()
    {
        // TODO: Implement get_all() method.
        return Fee_type::select()->get();
    }


    public function fee_type_id()
    {
        return Fee_type::select('id')->get();
    }

    public function store_fee_type($request)
    {
        try {
            $request;
            $request_count = count($request->fee);
            $fee =  $request->fee;
            $order =  $request->order;
            $primary_price =  $request->primary_price;
            $temp = [];
            DB::beginTransaction();
            for ($i = 0; $i < $request_count; $i++) {

                $temp[] = [
                    'fee'                =>     $fee[$i],
                    'order'            =>     $order[$i],
                    'primary_price'      =>     $primary_price[$i],
                    'created_at' =>  Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
            $inserted = Fee_type::insert($temp);
            DB::commit();
            if ($inserted) {
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            throw $th;
            DB::rollback();
        }
    }
    public function it_is_used($fee_types_id)
    {
        $fee_type_used = CoursFee::where('fee_types_id', $fee_types_id)->get();
        if ($fee_type_used->count() > 0)
            return true;
        return false;
    }
}
