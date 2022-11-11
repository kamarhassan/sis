<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServicesRequest extends FormRequest
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
        return [
            'services.*' => 'required',
            'fee.'. $this->fee_validate()['id']=> $this->fee_validate()['fee_err'],
            'currency.*' => 'required|exists:currencies,id',
            //   'grade.*' => 'required'
        ];
    }
    public  function messages()
    {
        return [
            'services.*.required' => __('site.its_require'),
            'fee.*.required' => __('site.its_require'),
            'fee.*.numeric' => __('site.must be a number if exist'),
            'currency.*.required' => __('site.its_require'),
            'currency.*.exists' => __('site.its_exists'),

        ];
    }

    private function  fee_validate()
    {
        foreach ($this->fee as $key => $fee) {
            if ($fee != null)
                return ['fee_err'=>"numeric",'id'=>$key];
        }
        return "";
    }
}
