<?php

namespace Modules\Cms\Http\Requests\Footer;

use Illuminate\Foundation\Http\FormRequest;

class FooterCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      
        return [
           'name' => 'required|max:255',
           'category' => 'required',
           'page' => 'nullable',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
