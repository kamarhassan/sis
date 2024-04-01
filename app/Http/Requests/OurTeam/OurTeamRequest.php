<?php

namespace App\Http\Requests\OurTeam;

use Illuminate\Foundation\Http\FormRequest;

class OurTeamRequest extends FormRequest
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
         'instructor'=>'required|exists:admins,id',
         'role'=>'required',
         'shortdescription'=>'required',
         
        ];
    }


    public  function messages()
    {
        return [
            '*.required' => __('site.its_require'),
            '*.exists' => __('site.its_exists'),

        ];
    }
}
