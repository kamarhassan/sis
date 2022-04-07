<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
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
            'code'      =>'required|max:30|string',
            'active'    =>'in:0,1',
            'name'      =>'required|max:100|string',
            'direction' =>'required|in:rtl,ltr'
        ];
    }
        public  function messages()
        {
            return [
                // 'required'=>'هذا الحقل مطلوب',
                // 'in'=>'القيمة المدخلة غير صحيحة',
                // 'name.string'=>'اسم اللغة يجب ان يكون احرف',
                // 'name.max'=>'اسم اللغة لا يجب ان يتعدى ال 100 حرف',
                // 'abbr.string'=>'اسم اللغة يجب ان يكون احرف',
                // 'abbr.max'=>'اسم اللغة لا يجب ان يتعدى ال 10 حرف'
            ];

        }
}
