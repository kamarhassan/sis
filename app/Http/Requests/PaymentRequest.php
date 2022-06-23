<?php

namespace App\Http\Requests;

use App\Models\Currency;
use App\Models\StudentsRegistration;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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

        return [
            'amount_to_paid' => $this->amount_to_paid($max_amount_to_paid),
            'check_number' => $this->checkNum(),
            'other_amount_to_paid' => $this->other_amount($max_amount_to_paid),
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
            if ($std->count() > 0) {
                return $std[0]['remaining'];
            } else {
                return 0;
            }
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return 0;
        }
    }


    public function checkNum()
    {
        if ($this->pay_type == 'pay_check_')
            return 'required|digits:14|numeric';
        else return "";
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
            //code...
            // if ($this->request->has('payment_methode')) {
            //     if (($this->cours_currency_abbr == "USD" || $this->cours_currency_abbr == "EUR") /*&& Currency::find($this->cours_currency)->abbr == "L.L"*/) {
            //         return -2;
            //         // $amount_to_paid= $this->other_amount_to_paid / $this->rate;
            //     } else {
            //         return -3;
            //         // $amount_to_paid= $this->other_amount_to_paid * $this->rate;
            //     }
            //     if ($amount_to_paid >= $max_amount_to_paid) {
            //         return 'required|numeric|min:1|max:' . $max_amount_to_paid;
            //     }
            // } else return "";
            $cours_curency_abbr = Currency::find($this->cours_currency);

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
                else     return 'required|numeric|min:1|max:' . $max_amount_to_paid;;
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
