<?php

namespace App\Http\Requests;

use App\Models\Receipt;
use App\Models\Currency;
use App\Models\StudentsRegistration;
use Illuminate\Foundation\Http\FormRequest;

class EditPaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */



    public function rules()
    {
        /****
         * $this->get_max_amount(decrypt($this->user_id), decrypt($this->cours_id));
         * get the max fees required
         * of this cours
         */
        $max_amount_to_paid =  $this->get_max_amount(decrypt($this->user_id), decrypt($this->cours_id));
        // dd($max_amount_to_paid);

        return [
            'amount_to_paid' => $this->amount_to_paid($max_amount_to_paid),
            'check_number' => $this->checkNum(),
            'other_amount_to_paid' => $this->other_amount($max_amount_to_paid),
            'cours_currency_id' => 'required|exists:currencies,id',

            'rate' => $this->rate(),
            'bank' => $this->bank(),
        ];
    }

    public  function messages()
    {
        return [
            '*.required' => __('site.its_require'),
            '*.numeric' => __('site.must be a number'),
            '*.min' => __('site.must be a number positive'),
            '*.max' => __('site.amount to paid must be under fees Or the rest')
                . "  " . $this->cours_currency_abbr . "  " . $this->get_max_amount(decrypt($this->user_id), decrypt($this->cours_id)),
            'chek_number.digits' => __('site.must be a only 14 number'),

        ];
    }

    public function get_max_amount($user_id, $cours_id)
    {
        try {
            $std = StudentsRegistration::where([
                'user_id' => $user_id,
                'cours_id' => $cours_id
            ])->get();
            $last_amount_paid =  Receipt::find($this->receipt_id);
            // dd($std[0]['remaining'] + $last_amount_paid->amount_total);
            if ($std->count() > 0) {
                return  $std[0]['remaining'] + $last_amount_paid->amount_total;
            } else {
                return -1;
            }
            //code...
        } catch (\Throwable $th) {
            // throw $th;
            return 0;
        }
    }


    public function checkNum()
    {
        if ($this->pay_type == 'pay_check_')
            return 'required|digits:14|numeric';
        else return "";
    }
    public function userId()
    {
        return  'required|exists:users,' . decrypt($this->user_id);
    }
    public function bank()
    {
        if ($this->pay_type == 'pay_check_')
            return 'required';
        else return "";
    }

    public function other_amount($max_amount_to_paid)
    {
        try {

            $cours_curency_abbr = Currency::find($this->other_payment_currency);

            if ($this->request->has('payment_methode')) {
                if (
                    strcmp($cours_curency_abbr['abbr'], "L.L") == 0
                    && (strcmp($this->cours_currency_abbr, "USD") == 0 || strcmp($this->cours_currency_abbr, "EUR") == 0)
                ) {
                    $amount_to_paid = $this->other_amount_to_paid / $this->rate;
                    // dd($amount_to_paid);
                } else {
                    $amount_to_paid = $this->other_amount_to_paid * $this->rate;
                }
                if ($amount_to_paid <= $max_amount_to_paid)
                    return 'required|numeric|min:1';
                else     return 'required|numeric|min:1|max:' . $max_amount_to_paid;
            } else return "";
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function amount_to_paid($max_amount_to_paid)
    {
        if (!$this->request->has('payment_methode'))
            return 'required|numeric|min:1|max:' . $max_amount_to_paid;
        else return "";
    }
    public function rate()
    {
        if ($this->request->has('payment_methode'))
            return 'required|numeric|min:1';
        else return "";
    }
}
