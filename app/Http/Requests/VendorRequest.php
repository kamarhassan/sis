<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Mail\Events\MessageSent;

class VendorRequest extends FormRequest
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
            'name'          => 'required|string|max:140',
            'logo'          => 'required_without:id|mimes:jpg,jpeg',
            'mobile'        => 'required|max:20',
            'address'       => 'required',
            'email'         => 'sometimes|nullable|email',
            'category_id'   => 'required|exists:main_categories,id',
            'active'        => 'in:0,1'
        ];
    }




 public function messages(){
        return [




        ];
 }

}
