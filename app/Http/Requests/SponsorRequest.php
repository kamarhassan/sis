<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SponsorRequest extends FormRequest
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

            'sponsor_name.*' => 'required',
            'sponsor_type.*' => 'required',
            'sponsor_default_percent.*' => 'required|numeric|min:1|max:100',
            'sponsor_limit.*' =>'required|numeric',
            'sponsor_students_limit.*'=> 'required|numeric',

        ];
    }

    public  function messages()
    {
        return [
            '*.required' => __('site.its_require'),
            '*.min' => __('site.must be a number positive min 1'),
            '*.max' => __('site.must be under 100 percent'),
            '*.numeric' => __('site.must be a number'),
        ];
    }
}
