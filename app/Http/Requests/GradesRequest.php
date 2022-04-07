<?php

namespace App\Http\Requests;

use GuzzleHttp\Psr7\Request;
use Illuminate\Auth\Events\Validated;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Foundation\Http\FormRequest;

class GradesRequest extends FormRequest
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
          'grade' => 'required',
        //   'grade.*' => 'required'
        ];
    }
    public  function messages()
    {
        return [
             'grade.required'=>__('site.its_require'),

        ];

    }


}
