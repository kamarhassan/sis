<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistrationRequest extends FormRequest
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
            'firstname' => ['required', 'string', 'max:255'],
            'midname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'phonenumber' => ['required', 'digits:8', 'numeric'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'birthday' => ['required', 'date'],
            'born_place' => ['required'],
        ];
    }



    public  function messages()
    {
        return [
            '*.required' => __('site.its_require'),
            '*.date' => __('site.cours date must be date'),
            'phonenumber.digits' => __('site.phone number must be 8'),

        ];
    }
}
