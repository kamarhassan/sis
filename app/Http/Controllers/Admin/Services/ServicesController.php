<?php

namespace App\Http\Controllers\Admin\Services;

use Carbon\Carbon;
use App\Models\Service;
use App\Models\Currency;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServicesEditRequest;
use App\Http\Requests\ServicesRequest;
use App\Models\UserService;

class ServicesController extends Controller
{
    public function create()
    {
        $currency = Currency::active()->get();
        $services = Service::with('currency')->paginate(1000);
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
                return   response()->json($notification);
            } else {
                $notification = [
                    'message' => __('site.faild to  craete new services'),
                    'status' => 'error',
                ];
                return  response()->json($notification);
            }
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollback();
            $notification = [
                'message' =>  __('site.you site.you have error'),
                'status' => 'error',
            ];
            return  response()->json($notification);

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

                $is_deletet = false;
                $its_it_used = UserService::where('service_id', $service->id)->get()->count();
                if (!$its_it_used)
                    $is_deletet = $service->delete();

                if ($is_deletet)
                    $notification = [
                        'message' => __('site.payment has delete success'),
                        'status' => 'success',
                    ];
                else {
                    $notification = [
                        'message' => __('site.payment faild to delete because it is used'),
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





    public function to_update($services_id)
    {


        try {
            $services =  Service::with('currency')->find($services_id);
            if (!$services) {
                $notification = [
                    'message' =>  __('site.services note defined'),
                    'status' => 'error',
                ];
                return  response()->json($notification);
            }
            return $services;
        } catch (\Throwable $th) {
            // throw $th;
            $notification = [
                'message' =>  __('site.you site.you have error'),
                'status' => 'error',
            ];
            return  response()->json($notification);
        }
    }





    public function update(ServicesEditRequest $request)
    {
        try {
            $request;
            $services =  Service::find($request->service_id);
            //code...
            if (!$services) {
                $notification = [
                    'message' =>  __('site.services note defined'),
                    'status' => 'error',
                ];
                return  response()->json($notification);
            }


            if (!$request->has('active'))
                $active = 0;
            else $active = 1;

            $updated =  $services->update([
                "service" => $request->service,
                "active" => $active,
                "fee" => $request->fee,
                "currencies_id" => $request->currency,
            ]);

            if (!$updated) {
                $notification = [
                    'message' =>  __('site.services not updated'),
                    'status' => 'error',
                ];
            } else {
                $notification = [
                    'message' =>  __('site.services has been updated'),
                    'status' => 'success',
                ];
            }
            
            return  response()->json($notification);
        } catch (\Throwable $th) {
            // throw $th;
            $notification = [
                'message' =>  __('site.you site.you have error'),
                'status' => 'error',
            ];
            return  response()->json($notification);
        }
    }
}

