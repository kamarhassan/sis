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
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\PaymentRequest;
use App\Mail\NotifyMailPaymentReceipt;
use App\Http\Requests\EditPaymentRequest;

class PaymentController extends Controller
{



    /****
     *
     *  after choose one cours to be paid
     *  it get all inforation needed
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
                    ->with('fee_type', 'currency')
                    ->get();
                //  return $fees;
                $payment = Payment::where('studentsRegistration_id', $std[0]['id'])->with('cours_fee')->get();
                // return $payment;

                // return $payment;
                $cours_currency = Currency::active()->get();
                return  view('admin.payment.payment', compact('std', 'user', 'cours', 'payment', 'fees', 'cours_currency'));
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

                    $other_payment_currency = $request->other_payment_currency;
                    $payment_currency_abbr = Currency::find($other_payment_currency);
                    // $payment_currency_abbr = Currency::find($request->cours_currency)->abbr;
                    /**
                        hon 3am ye3mal check isa l cours bl $ aw euro bado ye2sem yale 3am yedfa3on
                        bl lira lebneye 3al rate yale hye se3er saref
                        w eza la byodrob yale 3am yedfa3on bl rate
                     */
                    if (($cours_cuurency_abbr == "USD" || $cours_cuurency_abbr == "EUR" && $payment_currency_abbr->abbr == "L.L")) {
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

                // dd('true');
                $receipt_information =  Receipt::Create([
                    'currencies_id' => $other_payment_currency,
                    'cours_currency_id' => $request->cours_currency_id,
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

                $std_update_remaining = StudentsRegistration::where([
                    'user_id'  => decrypt($request->user_id),
                    'cours_id' => decrypt($request->cours_id)
                ])->update([
                    'remaining' => ($std[0]['remaining'] - $init_amount)
                ]);

                if ($old_payment->count() > 0) {
                    // return 150;
                    foreach ($old_payment as $key => $value) {
                        // $it[] =["initinal",'init_amount'=>$init_amount,'remaining'=>$value->remaining];
                        if ($value->remaining != 0) {
                            if ($init_amount >=  $value->remaining) {
                                /**
                                 'remaining' => $value->amount-($request->amount_to_paid + $value->paid_amount),
                                 hye l 2ime l2ejmelye lal fee type masal exam aw book aw fee registration aw shi tene
                                 l 2ime lejmelye na2es yale dafa3on ma3 yale keyen defe3on abel
                                 l2an momken ykon defe3 jeze2 men hede l 2ime
                                 w yale keyen defe3on bzyde 3layhon l2ime ljdide
                                 */
                                Payment::where('id', $value->id)
                                    ->update([
                                        'paid_amount' =>   $value->amount,
                                        'remaining' => 0,
                                        'receipt_id' => $receipt_information->id,
                                        'created_at' => Carbon::now()
                                    ]);
                                $init_amount -= $value->remaining;
                                // $it[] =["init_amount >= remaining",'init_amount'=>$init_amount,'remaining'=>$value->remaining];

                            } else {
                                Payment::where('id', $value->id)->update([
                                    'paid_amount' => $init_amount + $value->paid_amount,
                                    'remaining' => $value->amount - ($init_amount + $value->paid_amount),
                                    'receipt_id' => $receipt_information->id,
                                    'created_at' => Carbon::now()
                                ]);
                                // $it[] =["else ",'init_amount'=>$init_amount,'remaining'=>$value->remaining];
                                break;
                            }
                        }
                    }
                    // return $it;
                } else {

                    $fee_required =  string_to_array($std[0]['feesRequired']);
                    $fees  = CoursFee::wherein('id', $fee_required)
                        ->with('fee_type', 'currency')
                        ->get();
                    foreach ($fees as $key => $fee) {
                        if ($init_amount == 0) {
                            Payment::Create([
                                'studentsRegistration_id' => $std[0]['id'],
                                'amount' => $fee['value'], // initial amount
                                'paid_amount' => 0, //amount paided from students
                                'cours_fee_id' => $fee['id'], //
                                'remaining' => $fee['value'], //
                                'receipt_id' => $receipt_information['id'], //
                            ]);
                        } else {
                            if ($init_amount <= $fee['value']) {
                                //  return    $fee['value'];
                                Payment::Create(
                                    [
                                        'studentsRegistration_id' => $std[0]['id'],
                                        'amount' => $fee['value'], // initial amount
                                        'paid_amount' => $init_amount, //amount paided from students
                                        'remaining' => $fee['value'] - $init_amount, //
                                        'cours_fee_id' => $fee['id'], //
                                        'receipt_id' => $receipt_information['id'], //
                                    ]
                                );
                                $init_amount = 0;
                            } else {
                                Payment::Create(
                                    [
                                        'studentsRegistration_id' => $std[0]['id'],
                                        'amount' => $fee['value'], // initial amount
                                        'paid_amount' => $fee['value'], //amount paided from students
                                        'remaining' => 0, //
                                        'cours_fee_id' => $fee['id'], //
                                        'receipt_id' => $receipt_information['id'], //
                                    ]
                                );
                                $init_amount -= $fee['value'];
                            }
                        }

                        # code...
                    }
                    // return $fees_requird;
                }


                DB::commit();

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
            throw $th;
            DB::rollBack();
            $notification = [
                'message' => __('site.you have error'),
                'status' => 'error',

            ];
            return  response()->json($notification);
        }
    }
    /****
     * from here all methode using in controller
     */










    #########################################################
    #########################################################
    #########################################################
    /*

            Edit
    */
    #########################################################
    #########################################################
    #########################################################
    public function edit_payment($id)
    {

        $receipt = Receipt::find($id);
        if (!$this->is_last_receipt($id)) {
            toastr()->error(__('site.you can edit only the last receipt or receipt not found'));
            return redirect()->route('admin.all-receipt');
        }
        try {

            $receipt = Receipt::find($id);
            $cours = $receipt->StdRegistration;
            $currency = $receipt->currency;
            $students = $receipt->students;
            $payment = Payment::where('studentsRegistration_id', $receipt['studentsRegistration_id'])
                ->with('cours_fee')->get();
            $cours_currency = $payment[0]['cours_fee']['currency'];
            $currency_active = Currency::where('active', 1)->get();

            return view('admin.payment.edit_payment', compact(
                'receipt',
                'currency',
                'payment',
                'cours_currency',
                'cours',
                'students',
                'currency_active'
            ));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function save_edit_payment(EditPaymentRequest $request)
    {

        try {
            DB::beginTransaction();
            $receipt =  Receipt::find($request->receipt_id);

            $last_receipt = Receipt::latest('id')->where('deleted', '=', 1)->first();
            // $this->is_last_receipt($receipt->id)
            if (!$this->is_last_receipt($receipt->id)) {
                $notification = [
                    'message' => __('site.you can edit only the last receipt or receipt not found'),
                    'status' => 'error',
                ];

                return response()->json([route('admin.all-receipt'), $notification]);
            }

            $std_registration = StudentsRegistration::where([
                'user_id'  => decrypt($request->user_id),
                'cours_id' => decrypt($request->cours_id)
            ])->get();

            if ($receipt->count() > 0 && $std_registration->count() > 0) {
                if ($request->has('check_number')) {
                    $check_number = $request->check_number;
                    // $bank=$request->bank;
                } else {
                    $check_number = null;
                    // $bank=$request->bank;
                }
                $old_payment = Payment::where('studentsRegistration_id', $std_registration[0]['id'])
                    ->get();

                if ($request->has('payment_methode')) {
                    $cours_cuurency_abbr = $request->cours_currency_abbr;
                    $other_payment_currency = $request->other_payment_currency;
                    $payment_currency_abbr = Currency::find($other_payment_currency);
                    if (($cours_cuurency_abbr == "USD" || $cours_cuurency_abbr == "EUR" && $payment_currency_abbr->abbr == "L.L")) {
                        $init_amount = $request->other_amount_to_paid / $request->rate;
                    } else {
                        $init_amount = $request->other_amount_to_paid * $request->rate;
                    }
                    $other_amount = $request->other_amount_to_paid;
                    $rate_exchange = $request->rate;
                } else {
                    $init_amount  = $request->amount_to_paid;
                    $other_payment_currency = $request->cours_currency_id;
                    $other_amount = 0;
                    $rate_exchange = 1;
                }

                $old_remaining =  $receipt['amount_total'] + $std_registration[0]['remaining'];
                $new_remaining = $old_remaining - $init_amount;
                $old_amount = $receipt['amount_total'];

                $receipt_updated =  $receipt->update([
                    'currencies_id' => $other_payment_currency,
                    'cours_currency_id' => $request->cours_currency_id,
                    'amount' => $init_amount,
                    'other_amount' => $other_amount,
                    'amount_total' => $init_amount,
                    'description' => $request->receipt_description,
                    'rate_exchange' => $rate_exchange,
                    'payType' => $request->pay_type,
                    // 'user_id'  => $request->user_id,
                    // 'studentsRegistration_id' => $std_registration[0]['id'],
                    'checkNum' => $check_number,
                    // 'bank_' => $bank,
                ]);

                if ($init_amount > $old_amount) {
                    $init_amount = $init_amount - $old_amount;
                    // $t[] =  ['new init amount' => $init_amount];
                    // return $t;
                    $old_payment = Payment::where('studentsRegistration_id', $std_registration[0]['id'])
                        ->get();
                    if ($old_payment->count() > 0) {
                        // return 150;
                        foreach ($old_payment as $key => $value) {
                            // $it[] = ["initinal", 'init_amount' => $init_amount, 'remaining' => $value->remaining];
                            if ($value->remaining != 0) {
                                if ($init_amount >=  $value->remaining) {
                                    Payment::where('id', $value->id)->update([
                                        'paid_amount' =>   $value->amount,
                                        'remaining' => 0,
                                        'receipt_id' => $receipt->id,
                                        'created_at' => Carbon::now()
                                    ]);
                                    $init_amount -= $value->remaining;
                                    // $it[] = ["init_amount >= remaining", 'init_amount' => $init_amount, 'remaining' => $value->remaining];
                                } else {
                                    Payment::where('id', $value->id)->update([
                                        'paid_amount' => $init_amount + $value->paid_amount,
                                        'remaining' => $value->amount - ($init_amount + $value->paid_amount),
                                        'receipt_id' => $receipt->id,
                                        'created_at' => Carbon::now()
                                    ]);
                                    // $it[] = ["else ", 'init_amount' => $init_amount, 'remaining' => $value->remaining];
                                    break;
                                }
                            }
                        }
                    }

                    // return $t;
                    // return      $std_registration[0]['remaining'];
                } else {
                    /**
                     * start edit and delet receipt use it in finction to make delete code
                     */
                    $edit = $this->edit_delet($receipt->id, $std_registration[0]['id'], $old_amount, $init_amount); // edit if $old amount > = $initamount

                }

                // return $edit;
                $std_registration_updated = StudentsRegistration::where('id',  $receipt['studentsRegistration_id'])->update([
                    'remaining' => $new_remaining,
                ]);
                DB::commit();
                if ($std_registration_updated && $receipt_updated && $edit)
                    $notification = [
                        'message' => __('site.payment has been success'),
                        'status' => 'success',
                    ];
                else {
                    $notification = [
                        'message' => __('site.payment faild'),
                        'status' => 'error',

                    ];
                }
                return response()->json([route('admin.payment.receipt', [$request->user_id, $request->cours_id, $receipt->id]), $notification]);
            } else {
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function delete_payment_receipt(Request $request)
    {

        try {
            DB::beginTransaction();
            $receipt_id   = $request->id;
            $receipt = Receipt::find($receipt_id);
            if (!$this->is_last_receipt($receipt_id) || !$receipt) {
                $notification = [
                    'message' => __('site.you can delete only the last receipt or receipt not found'),
                    'status' => 'error',
                ];
                return response()->json($notification);
            }

            $std_registration = StudentsRegistration::find($receipt->studentsRegistration_id);
            $receipt_delet   =  $receipt->update(['deleted' => 0]);
            $edit = $this->edit_delet($receipt->id, $receipt->studentsRegistration_id, $receipt->amount_total, 0); // edit if $old amount > = $initamount
            $std_registration_updated = StudentsRegistration::where('id',  $receipt['studentsRegistration_id'])
                ->update(['remaining' => $std_registration->remaining + $receipt->amount_total]);
            if ($edit && $receipt_delet && $std_registration_updated)
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
            // return response()->json($notification);

            //code...
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    /*
        edit or delete if Old paid amount is greater than  the new paid amount
    */

    private function is_last_receipt($receipt_id)
    {
        try {

            $last_receipt = Receipt::latest('id')->where('deleted', '=', 1)->first();
            if ($receipt_id != $last_receipt->id)
                return false;
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function edit_delet($receipt_id, $std_registration_id, $old_amount, $init_amount)
    {
        $diff_old_init_anount =  $old_amount - $init_amount;
        try {
            //code...
            $old_payment = Payment::where('studentsRegistration_id', $std_registration_id)->where('paid_amount', '>', 0)
                ->get();
            for ($i = $old_payment->count() - 1; $i >= 0; $i--) {
                // return $old_payment[$i]->id;
                if ($diff_old_init_anount <= $old_payment[$i]->paid_amount) {
                    Payment::where('id', $old_payment[$i]->id)->update([
                        'paid_amount' => $old_payment[$i]->paid_amount - $diff_old_init_anount,
                        'remaining' => $old_payment[$i]->remaining + $diff_old_init_anount,
                        'receipt_id' => $receipt_id,
                        'created_at' => Carbon::now()
                    ]);
                    break;
                } else {
                    Payment::where('id', $old_payment[$i]->id)->update([
                        'paid_amount' => 0,
                        'remaining' => $old_payment[$i]->amount,
                        'receipt_id' => $receipt_id,
                        'created_at' => Carbon::now()
                    ]);
                    $diff_old_init_anount -= $old_payment[$i]->paid_amount;
                }
            }
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
