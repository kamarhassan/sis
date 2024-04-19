<?php

namespace App\Http\Requests\InstitueInfromation;

use Illuminate\Foundation\Http\FormRequest;

class EditInstitueInformation extends FormRequest
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
     * */
    public function rules()
    {
        return [
            'id'=>'required|exists:institue_informations,id',
            'building' => 'required|max:255',
            'city' => 'required|max:255',
            'email' => 'required|email|max:255',
            'name' => 'required|max:255',
            'phone' => 'required',
        ];
    }
    public  function messages()
    {
        return [
            '*.required' => __('site.its_require'),
            '*.numeric' => __('site.must be a number'),
            '*.email' => __('site.import email is not valid'),
            //'*.max' => __('site.') ,



        ];
    }
}
