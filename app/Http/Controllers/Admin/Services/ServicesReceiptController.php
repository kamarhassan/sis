<?php

namespace App\Http\Controllers\Admin\Services;

use App\Models\User;
use App\Models\Service;
use App\Models\Currency;
use App\Models\UserService;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ServiceReceipt;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ServicesReceiptController extends Controller
{
    public function receipt($receipt_id)
    {
        $service_repceit =   ServiceReceipt::find($receipt_id);
        //   return $receipt_id;
        if ($service_repceit->count() > 0) {
            $user_service = UserService::find($service_repceit['user_service_id']);
            $user = User::find($user_service['user_id']);
            $service = Service::find($user_service['service_id']);
            $currency = Currency::find($service['currencies_id']);
            $data = [
                'service_repceit' => $service_repceit,
                'user_service' => $user_service,
                'user' => $user,
                'service' => $service,
                'currency' => $currency,
            ];
            return  view('admin.services.receipt.receipt', compact('service_repceit', 'user_service', 'user', 'service', 'currency'));
            $contains1 = Str::contains(url()->previous(), 'Payment');
            $contains2 = Str::contains(url()->previous(), 'edit-old-payment');
            if ($contains1 || $contains2)
                // Mail::to($user['email'])->send(new NotifyMailPaymentReceipt($data));
                if (Mail::failures()) {
                } else {
                    return  view('admin.services.receipt.receipt', compact('service_repceit', 'user_service', 'user', 'service', 'currency'));
                }
        } else {
            toastr()->error(__('site.this registration not found'));
            return redirect()->route('admin.all-receipt');
        }
    }


    public function All_receipt()
    {
        try {
            $service_repceit = ServiceReceipt::with([
                'client_services', 'services_',
                'client:id,name,email', 'services_currency:id,currency,abbr,symbol'
            ])->get();

            return view('admin.services.receipt.index', compact('service_repceit'));
            //code...
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function delete_payment_receipt(Request $request)
    {
        // return $request;
        try {
            DB::beginTransaction();
            if (!$this->is_last_receipt($request->id)) {
                $notification = [
                    'message' => __('site.you can delete only the last receipt or receipt not found'),
                    'status' => 'error',
                ];
                return response()->json($notification);
            }
            $service_repceit = ServiceReceipt::find($request->id);
            $user_service = UserService::find($service_repceit['user_service_id']);
            // $user_service->update([
            //     'paid_amount' => $user_service['paid_amount'] - $service_repceit['amount_total'],
            //     'remaining' =>  $user_service['remaining'] + $service_repceit['amount_total'],
            // ]);
            // $service_repceit->delete();
            $service_repceit->delete();
            $user_service->delete();

            DB::commit();
            if ($user_service && $service_repceit) {
                $notification = [
                    'message' => __('site.succes_msj_swal_fire'),
                    'status' => 'success',
                ];
                return response()->json($notification);
            } else {
                $notification = [
                    'message' => __('site.failed_delete'),
                    'status' => 'error',
                ];
                return response()->json($notification);
            }
        } catch (\Throwable $th) {
            DB::rollback();
            $notification = [
                'message' => __('site.you site.you have error'),
                'status' => 'error',
            ];
            return response()->json($notification);
            // throw $th;
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
