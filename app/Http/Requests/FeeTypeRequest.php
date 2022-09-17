<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeeTypeRequest extends FormRequest
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
            'fee.*' => 'required',
            'order.*' => 'required|numeric|unique:fee_types,order',
            // 'order.*' => 'required|unique:fee_types,order,except,id',
            // 'primary_price.*' => $this->primary_price(),
            //   'grade.*' => 'required'
        ];
    }
    public  function messages()
    {
        return [
            'fee.*.required' => __('site.its_require'),
            'order.*.required' => __('site.its_require'),
            'order.*.numeric' => __('site.must be a number'),
            'order.*.unique' => __('site.must be a unique'),
            // 'primary_price.*.required' => __('site.its_require'),
            // 'primary_price.*.numeric' => __('site.must be a number'),
            
        ];
    }
    // private function primary_price(){
    //     if ($this->request->has('primary_price'))
    //         return 'numeric' ;
    //     else return "";
    // }
}
