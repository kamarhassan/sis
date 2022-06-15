<?php

namespace App\Http\Requests;

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
            '*.max' => __('site.amount to paid must be under fees Or the rest'),

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
        if ($this->request->has('payment_methode'))
            return 'required|numeric|min:1|max:' . $max_amount_to_paid;
        else return "";
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
