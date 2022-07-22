<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServicesEditRequest extends FormRequest
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
            'service' => 'required',
            'fee' => 'required|numeric',
            'currency' => 'required|exists:currencies,id',
            //   'grade.*' => 'required'
        ];
    }
    public  function messages()
    {
        return [
            'service.required' => __('site.its_require'),
            'fee.required' => __('site.its_require'),
            'fee.numeric' => __('site.must be a number'),
            'currency.required' => __('site.its_require'),
            'currency.exists' => __('site.its_exists'),

        ];
    }
}
