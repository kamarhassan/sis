<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationStydentsRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'cours_id' => 'required|exists:courss,id',
        ];
    }
    public  function messages()
    {
        return [
            '*.required' => __('site.its_require'),
            'user_id.exists' => __('site.its_require'),
            'cours_id.exists' =>__('site.its_require'),

        ];
    }
}
