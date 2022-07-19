<?php

namespace App\Http\Controllers\Admin\Services;

use Carbon\Carbon;
use App\Models\Service;
use App\Models\Currency;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServicesRequest;

class ServicesController extends Controller
{
    public function create()
    {
        $currency = Currency::active()->get();
        $services = Service::active()->with('currency')->get();
        return view('admin.services.services.create', compact('currency', 'services'));
    }

    public function store(ServicesRequest $request)
    {

        try {
            $request_count = count($request->services);
            $services =  $request->services;
            $fee =  $request->fee;
            $currencyid =  $request->currency;
            $temp = [];
            DB::beginTransaction();
            for ($i = 0; $i < $request_count ; $i++) {

                $temp[] = [
                    'service'            =>     $services[$i],
                    'fee'                =>     $fee[$i],
                    'currencies_id'      =>     $currencyid[$i],
                    'created_at' =>  Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
            $inserted = Service::insert($temp);
            DB::commit();
            if ($inserted) {

                $notification = [
                    'message' => __('site.services succefuly inserted'),
                    'status' => 'success',

                ];
                return   response()->json([ $notification,$temp]);
            } else {
                $notification = [
                    'message' => __('site.faild to  craete new services'),
                    'status' => 'error',
                ];
                return  response()->json($notification);
            }
        } catch (\Throwable $th) {
            throw $th;
            DB::rollback();
        }

        // return $request;
    }
}
