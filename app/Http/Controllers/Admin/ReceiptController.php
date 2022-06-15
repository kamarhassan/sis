<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Cours;
use App\Models\Payment;
use App\Models\Receipt;
use App\Models\CoursFee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StudentsRegistration;

class ReceiptController extends Controller
{
    //

    public function receipt($user_id, $cours_id, $receipt_id)
    {
        try {
            //code...
            $receipt_id = $receipt_id;
            // $init_amount = $init_amount;
            $std = StudentsRegistration::where([
                'user_id'  => decrypt($user_id),
                'cours_id' => decrypt($cours_id)
            ])->get();

            if ($std->count() > 0) {

                $user =  User::find(decrypt($user_id));
                $cours = Cours::where('id', $cours_id)
                    ->with('grade:id,grade', 'level:id,level', 'teacher:id,name')
                    ->get();
                $fee_required =  string_to_array($std[0]['feesRequired']);
                $fees  = CoursFee::wherein('id', $fee_required)
                    ->with('fee_type', 'currency', 'payment:id,amount,paid_amount,remaining,cours_fee_id,created_at')
                    ->get();

                $old_payment = Payment::where('studentsRegistration_id', $std[0]['id'])->get();
               $receipt = Receipt::find($receipt_id);

                return  view('admin.receipt.receipt', compact('std', 'user', 'cours', 'fees', 'receipt'));
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
}
