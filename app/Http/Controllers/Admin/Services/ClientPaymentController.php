<?php

namespace App\Http\Controllers\Admin\Services;


use App\Models\User;
use App\Models\Service;
use App\Models\Currency;
use App\Models\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientPaymentRequest;
use App\Models\ServiceReceipt;

class ClientPaymentController extends Controller
{
    //

    public  function user_paid_for_services1($client_services_id)
    {

        try {
            return $client_services_id;
            // return $service_id;
            // $client_services = UserService::find($service_id);
            // $service_currency = Currency::active()->get();
            // $user = User::find($client_services['user_id']);
            // $service = Service::with('currency')->find($service_id);
            // return view('admin.services.payment.payment', compact('service_currency', 'user', 'service', 'client_services'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public  function user_paid_for_services($service_id)
    {

        try {
            // return $service_id;
            $client_services = UserService::find($service_id);
            $service_currency = Currency::active()->get();
            $user = User::find($client_services['user_id']);
            $service = Service::with('currency')->find($client_services['service_id']);
            return view('admin.services.payment.payment', compact('service_currency', 'user', 'service', 'client_services'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function savepaymentCient(ClientPaymentRequest $request)
    {
        try {
            // return $request;
            $client_services_id = decrypt($request->client_services_id);
            DB::beginTransaction();
            $client_services = UserService::find($client_services_id);

            if ($request->has('check_number')) {
                $check_number = $request->check_number;
                // $bank=$request->bank;
            } else {
                $check_number = null;
                // $bank=$request->bank;
            }
            if ($client_services->count() > 0) {
                // return $std[0]['id'];

                if ($request->has('rate')) {
                    $rate_exchange = $request->rate;
                } else {
                    $rate_exchange = 1;
                }

                if ($request->has('payment_methode')) {
                    $service_curency_abbr = $request->service_currency_abbr;
                    $other_payment_currency = $request->other_payment_currency;
                    $payment_currency_abbr = Currency::find($other_payment_currency);
                    if (($service_curency_abbr == "USD" || $service_curency_abbr == "EUR" && $payment_currency_abbr->abbr == "L.L")) {
                        $init_amount = $request->other_amount_to_paid / $request->rate;
                    } else {
                        $init_amount = $request->other_amount_to_paid * $request->rate;
                    }
                } else {
                    $init_amount  = $request->amount_to_paid;
                    $other_payment_currency = $request->service_currency_id;
                }

                $receipt_information =  ServiceReceipt::Create([

                    'currencies_id' =>    $other_payment_currency,
                    'service_currency_id' => $request->service_currency_id,
                    'amount' => $init_amount,
                    'other_amount' => $request->other_amount_to_paid,
                    'description' => $request->receipt_description,
                    'rate_exchange' => $rate_exchange,
                    'payType' => $request->pay_type,
                    'user_id'  => decrypt($request->user_id),
                    'user_service_id' =>  $client_services['id'],
                    'amount_total' => $init_amount,
                    'checkNum' => $check_number,
                    // 'bank_' => $bank,
                ]);

                $client_services->update([

                    'paid_amount' => $init_amount,
                    'remaining' => $client_services['remaining'] - $init_amount,
                ]);
            }
            DB::commit();
            if (  $receipt_information && $client_services)
                $notification = [
                    'message' => __('site.payment has been success'),
                    'status' => 'success',
                ];
            // return  response()->json($notification);
            else {
                $notification = [
                    'message' => __('site.payment faild'),
                    'status' => 'error',

                ];
            }
            // $t = route('admin.payment.service.receipt',  $receipt_information->id);
            // return $t;
            return response()->json([route('admin.payment.service.receipt', $receipt_information->id), $notification]);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            $notification = [
                'message' => __('site.you have error'),
                'status' => 'error',

            ];
            return  response()->json($notification);
        }
    }
}
