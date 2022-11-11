<?php

namespace App\Http\Requests\Services;

use App\Models\Currency;
use App\Models\UserService;
use Illuminate\Foundation\Http\FormRequest;

class ClientPaymentRemainingRequest extends FormRequest
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
        $max_amount_to_paid =  $this->get_max_amount(decrypt($this->client_services_id));
        return [
            'amount_to_paid' => $this->amount_to_paid($max_amount_to_paid),
            'check_number' => $this->checkNum(),
            'other_amount_to_paid' => $this->other_amount($max_amount_to_paid),
            'service_currency_id' => 'required|exists:currencies,id',
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
                . "  " . $this->service_currency_abbr . "  " . $this->get_max_amount(decrypt($this->client_services_id)),
            'chek_number.digits' => __('site.must be a only 14 number'),

        ];
    }


    private function get_max_amount($service_client_id)
    {
       
        try {
            $client_services = UserService::where('id', $service_client_id)->get();     
            if ($client_services->count() > 0) {
                return $client_services[0]->remaining;
            } else {
                return 0;
            }
        } catch (\Throwable $th) {
            throw $th;
            return -1;
        }
    }

    private function amount_to_paid($max_amount_to_paid)
    {
        if (!$this->request->has('payment_methode'))
            return 'required|numeric|min:1|max:' . $max_amount_to_paid;
        else return "";
    }
    //
    private function checkNum()
    {
        if ($this->pay_type == 'pay_check_')
            return 'required|digits:14|numeric';
        else return "";
    }
  
    private function bank()
    {
        if ($this->pay_type == 'pay_check_')
            return 'required';
        else return "";
    }

    private function other_amount($max_amount_to_paid)
    {
        try {
            if ($this->request->has('payment_methode')) {
            
                $service_curency_abbr = Currency::find($this->other_payment_currency);
                if (
                    strcmp($service_curency_abbr['abbr'], "L.L") == 0
                    && (strcmp($this->service_currency_abbr, "USD") == 0 || strcmp($this->service_currency_abbr, "EUR") == 0)
                    && $this->rate > 0
                ) {
                    $amount_to_paid = $this->other_amount_to_paid / $this->rate;

                } else {
                    $amount_to_paid = $this->other_amount_to_paid * $this->rate;
                } 
                //    dd($amount_to_paid );
                if ($amount_to_paid <= $max_amount_to_paid)
                    return 'required|numeric|min:1';
                else     return 'required|numeric|min:1|max:' . $max_amount_to_paid;
            } else return "";
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function rate()
    {
        if ($this->request->has('payment_methode'))
            return 'required|numeric|min:1';
        else return "";
    }
    
}
