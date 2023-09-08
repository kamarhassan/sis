<?php

namespace App\Http\Requests\Certificate;

use Illuminate\Foundation\Http\FormRequest;

class CertificateRequest extends FormRequest
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
            'certificate' => 'required|max:255|unique:certificates,name,except,id',
            'categories'  => 'required|array',
            'categories.*'  => 'required|exists:categories,id',
            // 'level' => 'required|array',
            // 'level.*' => 'exists:levels,id',
        ];
    }
    public  function messages()
    {
        return [
            '*.required' => __('site.its_require'),
            '*.exists' => __('site.its_exists'),
            '*.unique'  =>__('site.unique')

        ];
    }
}
