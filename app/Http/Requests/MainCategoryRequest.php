<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MainCategoryRequest extends FormRequest
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
            'photo' => 'mimes:png,jpg,jpeg',

            'categories' =>'required|array|min:1',
            'categories.*.name' =>'required',
            'categories.*.abbr' =>'required',
            // 'categories.*.active' =>'required',

        ];
    }

    // public function messages()
    // {
    //     return[

    //         'photo.mimes'   =>"{{ __('messages.photo mimes') }}",
    //         '.*.name.required' =>'{{ __(messages.categoriy name required) }}',
    //         '.*.abbr.required' =>'{{ __(messages.abbr name required) }}',
    //     ];
    // }

}
