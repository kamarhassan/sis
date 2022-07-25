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
                return $client_services;
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
                    // return "line 129";
                    $init_amount  = $request->amount_to_paid;
                    $other_payment_currency = $request->cours_currency_id;
                    // return $payment_currency;
                }
            }
            DB::commit();

            return $request;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
