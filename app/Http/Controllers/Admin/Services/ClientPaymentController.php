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
use App\Http\Requests\EditClientPaymentRequest;
use App\Models\ServiceReceipt;
use PhpParser\Node\Stmt\TryCatch;

class ClientPaymentController extends Controller
{
    //


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
                    'amount' => $request->amount_to_paid,
                    'other_amount' => $request->other_amount_to_paid,
                    'description' => $request->receipt_description,
                    'rate_exchange' => $rate_exchange,
                    'payType' => $request->pay_type,
                    'user_id'  => decrypt($request->user_id),
                    'service_id'  => $client_services['service_id'],
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
            if ($receipt_information && $client_services)
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




    public function get_old_payment($receipt_id)
    {
        try {

            $client_receipt = ServiceReceipt::find($receipt_id);
            if (!$this->is_last_receipt($receipt_id)) {
                $notification = [
                    'message' => __('site.you can edit only the last receipt or receipt not found'),
                    'status' => 'error',
                ];

                toastr()->error(__('site.you can edit only the last receipt or receipt not found'));
                return redirect()->route('admin.Services.all-receipt');
            } else {
                $client_services = UserService::find($client_receipt['user_service_id']);
                $user = User::find($client_services['user_id']);
                $service = Service::find($client_services['service_id']);
                $service_currency = Currency::find($service['currencies_id']);
                $currency = Currency::active()->get();
                return view('admin.services.payment.edit-old-paymnet', compact('client_receipt', 'client_services', 'user', 'service', 'currency'));
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit_payment(EditClientPaymentRequest $request)
    {
        try {
            DB::beginTransaction();

            $receipt_id  = decrypt($request->client_receipt);

            $client_receipt = ServiceReceipt::find($receipt_id);
            if (!$this->is_last_receipt($receipt_id)) {
                $notification = [
                    'message' => __('site.you can edit only the last receipt or receipt not found'),
                    'status' => 'error',
                ];
                return response()->json([route('admin.Services.all-receipt'), $notification]);
            } else {
                if ($request->has('check_number')) {
                    $check_number = $request->check_number;
                    // $bank=$request->bank;
                } else {
                    $check_number = null;
                    // $bank=$request->bank;
                }

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
                $update_receipt =  $client_receipt->update([
                    'currencies_id' => $other_payment_currency,
                    'amount' => $request->amount_to_paid,
                    'other_amount' => $request->other_amount_to_paid,
                    'rate_exchange' =>  $rate_exchange,
                    'amount_total' => $init_amount,
                    'description' => $request->description,
                    'checkNum' => $request->checkNum,
                    'payType' => $request->payType,
                ]);
                $client_service = UserService::find($client_receipt['user_service_id']);

                if ($init_amount < $client_receipt['amount_total']) {
                    $paid_amount = $client_receipt['amount_total']  - $init_amount;
                    $remaining =  $client_service['amount'] - $init_amount;
                } else {
                    $paid_amount = $init_amount;
                    $remaining = $client_service['amount'] - $init_amount;
                }

                $client_service_update = $client_service->update([
                    'paid_amount' => $paid_amount,
                    'remaining' => $remaining,
                ]);
                DB::commit();

                if ($client_service && $client_service_update) {
                    $notification = [
                        'message' => __('site.payment has been success'),
                        'status' => 'success',
                    ];
                 } else {
                    $notification = [
                        'message' => __('site.payment faild'),
                        'status' => 'error',

                    ];
                }
                return response()->json([route('admin.payment.service.receipt', $receipt_id ), $notification]);



            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    private function is_last_receipt($receipt_id)
    {
        try {

            $last_receipt = ServiceReceipt::latest('id')->where('deleted', '=', 1)->first();
            if ($receipt_id != $last_receipt->id)
                return false;
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
