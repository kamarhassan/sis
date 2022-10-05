<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChanePasswordFirstLoggedRequest extends FormRequest
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
            'password' => 'required_with:re_password|same:re_password',
            're_password' => 'required',
        ];
    }

    public  function messages()
    {
        return [
            '*.required' => __('site.its_require'),
            'password.same' => __('site.retype same password'),
           

        ];
    }
}
