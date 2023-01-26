<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetStudentsForSponsore extends FormRequest
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
            'sponsor' =>'required|numeric|exists:sponsors,id'
        ];
    }
    public  function messages()
    {
        return [
            'sponsor.required' => __('site.its_require'),
            'sponsor.exists' => __('site.its_exists'),
            'sponsor.numeric' => __('site.must be a number'),
            // 'order.*.unique' => __('site.must be a unique'),
        
            
        ];
    }
}
