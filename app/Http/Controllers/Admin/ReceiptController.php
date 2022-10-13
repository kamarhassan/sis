<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Cours;
use App\Models\Payment;
use App\Models\Receipt;
use App\Mail\testnotify;
use App\Models\CoursFee;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StudentsRegistration;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyMailPaymentReceipt;

class ReceiptController extends Controller
{
    //
    public function __construct()
    {
      
     }

    public function receipt($user_id, $cours_id, $receipt_id)
    {
        try {
            //  decrypt($cours_id) ." \n".decrypt($user_id);
            $receipt_id = $receipt_id;
            // $init_amount = $init_amount;
            $std = StudentsRegistration::where([
                'user_id'  => decrypt($user_id),
                'cours_id' => decrypt($cours_id)
            ])->get();

            if ($std->count() > 0) {

                $user =  User::find(decrypt($user_id));
                // dd($user['email']);
                $cours = Cours::where('id', decrypt($cours_id))
                    ->with('grade:id,grade', 'level:id,level', 'teacher:id,name')
                    ->get();
                                  $fee_required =  string_to_array($std[0]['feesRequired']);
                $fees  = CoursFee::wherein('id', $fee_required)
                    ->with('fee_type', 'currency', 'payment:id,amount,paid_amount,remaining,cours_fee_id,created_at')
                    ->get();
                // return $fees;
                $old_payment = Payment::where('studentsRegistration_id', $std[0]['id'])->with('cours_fee')->get();

                //  return $old_payment;
                $receipt = Receipt::find($receipt_id);
                $currency = $receipt->cours_currency;
                $data = [
                    'std' => $std,
                    'user' => $user,
                    'cours' => $cours,
                    'fee_required' => $fee_required,
                    'fees' => $fees,
                    'old_payment' => $old_payment,
                    'receipt' => $receipt,
                    'currency' => $currency,
                ];
                $contains1 = Str::contains(url()->previous(), 'payment');
                $contains2 = Str::contains(url()->previous(), 'edit-old-payment');
                if ($contains1 ||$contains2)
                //   Mail::to($user['email'])->send(new NotifyMailPaymentReceipt($data));

                if (Mail::failures()) {
                    // toastr()->error(__('site.eror in sending email'));
                    return  view('admin.receipt.receipt', compact('std', 'user', 'cours', 'old_payment', 'fees', 'receipt', 'currency'));
                } else {
                    return  view('admin.receipt.receipt', compact('std', 'user', 'cours', 'old_payment', 'fees', 'receipt', 'currency'));
                }

            } else {
                toastr()->error(__('site.eror in sending email'));
                return redirect()->route('admin.students.get_std_to_payment');
            }
        } catch (\Throwable $th) {
            //  throw $th;
            toastr()->error(__('site.eror in sending email'));
            return redirect()->route('admin.students.get_std_to_payment');
        }


        // return $id." - ". $t;
    }


    public function All_receipt()
    {

        try {
            $receipt =  Receipt::orderBy('id', 'DESC')->where('deleted',1) // 1 is not delete
                ->with(['StdRegistration:id,user_id,cours_id', 'students:id,name,email', 'cours_currency'])
                ->paginate(1000);


            return view('admin.receipt.index', compact('receipt'));
            //code...
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
