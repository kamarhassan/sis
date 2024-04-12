<?php

namespace App\Http\Requests\FrontEnd\ContactUs;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
         'name' => 'required|string|max:255',
         'email' => 'required|email',
         'subject' => 'required|string|max:255',
         'message' => 'required|string',
         
        ];
    }
    public  function messages()
    {
        return [
            '*.required' => __('site.its_require'),        
            '*.email' => __('site.import email is not valid'),
        ];
    }
}
