<?php

namespace App\Http\Controllers\Admin\Services;

use Carbon\Carbon;
use App\Models\Service;
use App\Models\Currency;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServicesRequest;

class ServicesController extends Controller
{
    public function create()
    {
        $currency = Currency::active()->get();
        $services = Service::active()->with('currency')->paginate(1000);
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
            for ($i = 0; $i < $request_count; $i++) {

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
                return   response()->json([$notification, $temp]);
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


    public function delete(Request $request)
    {
        // return $request;
        try {
            $service = Service::find($request->id);
            if (!$service) {
                $notification = [
                    'message' => __('site.services note defined'),
                    'status' => 'error',

                ];
                //toastr()->error(__('site.services note defined'));
                // return redirect()->route('admin.grades.add');
            } else {
                $is_deletet = $service->delete();
                if ($is_deletet)
                    $notification = [
                        'message' => __('site.payment has delete success'),
                        'status' => 'success',
                    ];
                else {
                    $notification = [
                        'message' => __('site.payment faild '),
                        'status' => 'error',
                    ];
                }
                DB::commit();
               return response()->json($notification);
            }
        } catch (\Exception $th) {
            // throw $th;
             $notification = [
                        'message' => __('site.you have error'),
                        'status' => 'error',
                    ];
            // toastr()->error(__('site.you have error'));
            return response()->json($notification);
        }

        # code...
    }
}
