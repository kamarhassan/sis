<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Cours;
use App\Models\Payment;
use App\Models\Receipt;
use App\Models\CoursFee;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\StudentsRegistration;
use App\Http\Requests\PaymentRequest;

class PaymentController extends Controller
{
    //

    public function index()
    {
        return "1";
    }





    /****
     *
     * after choose one cours to be paid
     * it get all inforation needed
     *  $user ,  $cours ,   $fee_required ,   $fees  ,  $old_payment
     *
     */
    public function  user_paid_for_cours($cours_id, $user_id)
    {
        try {
            //code...

            $std = StudentsRegistration::where([
                'user_id' => $user_id,
                'cours_id' => $cours_id
            ])->get();
            //  return $std;
            if ($std->count() > 0) {
                $user =  User::where('id', $user_id)->select('id', 'name')->get();

                $cours = Cours::where('id', $cours_id)
                    ->with('grade:id,grade', 'level:id,level', 'teacher:id,name')
                    ->get();

                $fee_required =  string_to_array($std[0]['feesRequired']);

                $fees  = CoursFee::wherein('id', $fee_required)
                    ->with('fee_type', 'currency', 'payment:id,amount,paid_amount,remaining,cours_fee_id')
                    ->get();

                $old_payment = Payment::where('studentsRegistration_id', $std[0]['id'])->get();
                $cours_currency = Currency::active()->get();
                return  view('admin.payment.payment', compact('std', 'user', 'cours', 'fees', 'cours_currency'));
            } else {

                toastr()->error(__('site.this registration not found'));
                return redirect()->route('admin.students.get_std_to_payment');
            }
        } catch (\Throwable $th) {
            throw $th;
            // toastr()->error(__('site.you have error'));
            // return redirect()->route('admin.students.get_std_to_payment');
        }


        // return $id." - ". $t;
    }
    public function savepayment(PaymentRequest $request)
    {

        return $request;
        try {
            DB::beginTransaction();
            //code...
            $std = StudentsRegistration::where([
                'user_id'  => decrypt($request->user_id),
                'cours_id' => decrypt($request->cours_id)
            ])->get();
            if ($request->has('check_number')) {
                $check_number = $request->check_number;
                // $bank=$request->bank;
            } else {
                $check_number = null;
                // $bank=$request->bank;
            }
            if ($std->count() > 0) {
                // return $std[0]['id'];
                $old_payment = Payment::where('studentsRegistration_id', $std[0]['id'])
                    ->with('cours_fee:id,currencies_id')->get();

                if ($request->has('rate')) {
                    $rate_exchange = $request->rate;
                } else {
                    $rate_exchange = 1;
                }


                if ($request->has('payment_methode')) {

                    $cours_cuurency_abbr = $request->cours_currency_abbr;

                    $payment_currency = $request->cours_currency;
                    $payment_currency_abbr = Currency::find($payment_currency);
                    // $payment_currency_abbr = Currency::find($request->cours_currency)->abbr;
                    /**
                        hon 3am ye3mal check isa l cours bl $ aw euro bado ye2sem yale 3am yedfa3on
                        bl lira lebneye 3al rate yale hye se3er saref
                        w eza la byodrob yale 3am yedfa3on bl rate
                     */
                    if (($cours_cuurency_abbr == "USD" || $cours_cuurency_abbr == "EUR" && $payment_currency_abbr->abbr == "L.L")) {
                        $init_amount = $request->other_amount / $request->rate;
                    } else {
                        $init_amount = $request->other_amount * $request->rate;
                    }
                } else {
                    $init_amount  = $request->amount_to_paid;
                    $payment_currency = $old_payment[0]['cours_fee']['currencies_id'];
                    return $payment_currency;
                }


                $receipt_information =  Receipt::Create([
                    'currencies_id' => $payment_currency,
                    'amount' => $init_amount,
                    'other_amount' => $request->other_amount_to_paid,
                    'description' => $request->receipt_description,
                    'rate_exchange' => $rate_exchange,
                    'payType' => $request->pay_type,
                    'user_id'  => decrypt($request->user_id),
                    'studentsRegistration_id' => $std[0]['id'],
                    'amount_total' => $init_amount,
                    'checkNum' => $check_number,
                    // 'bank_' => $bank,
                ]);
                foreach ($old_payment as $key => $value) {
                    # code...
                    if ($value->remaining != 0) {
                        if ($request->amount_to_paid  >=  $value->remaining) {
                            /**
                             'remaining' => $value->amount-($request->amount_to_paid + $value->paid_amount),
                             hye l 2ime l2ejmelye lal fee type masal exam aw book aw fee registration aw shi tene
                             l 2ime lejmelye na2es yale dafa3on ma3 yale keyen defe3on abel
                             l2an momken ykon defe3 jeze2 men hede l 2ime
                             w yale keyen defe3on bzyde 3layhon l2ime ljdide
                             */
                            Payment::where('id', $value->id)
                                ->update([
                                    'paid_amount' => $value->amount,
                                    'remaining' => 0,
                                    'receipt_id' => $receipt_information->id,
                                    'created_at' => Carbon::now()
                                ]);
                            $request->amount_to_paid -= $value->remaining;
                        } else {

                            Payment::where('id', $value->id)->update([
                                'paid_amount' => $request->amount_to_paid,
                                'remaining' => $value->amount - $request->amount_to_paid,
                                'receipt_id' => $receipt_information->id,
                                'created_at' => Carbon::now()
                            ]);
                            break;
                        }
                    }
                }

                // $old_payment->where('id', $value->id)
                //     ->update($payment_data);

                // cours_fee_total  remaining
                $std_update_remaining = StudentsRegistration::where([
                    'user_id'  => decrypt($request->user_id),
                    'cours_id' => decrypt($request->cours_id)
                ])->update([
                    'remaining' => ($std[0]['remaining'] - $init_amount)
                ]);


                DB::commit();
                // return response()->json("remaning       ".($std[0]['remaining'] - $init_amount));
                // return response()->json(( $init_amount));
                // return response()->json($std[0]['cours_fee_total'] );
                // $notification = [
                //     'message' => __('site.payment has been success'),
                //     'status' => 'success',
                // ];
                if ($std_update_remaining)
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
                // return  response()->json($notification);


                return response()->json([route('admin.payment.receipt', [$request->user_id, $request->cours_id, $receipt_information->id]), $notification]);

                // return response()->json($old_payment[0]['cours_fee']['currencies_id']);
                // DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            $notification = [
                'message' => __('site.you have error'),
                'status' => 'error',

            ];
            // $notification = [
            //     'message' => __('site.you have error'),
            //     'status' => 'error',

            // ];
            return  response()->json($notification);
            throw $th;
        }
    }
}
