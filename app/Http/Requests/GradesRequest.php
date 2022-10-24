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
            'grades.*' => 'required',
            'total_hours.*' => 'required|numeric',
            'period_by_mounth.*' => 'required|numeric',

            //   'grade' => 'required',
            //   'grade.*' => 'required'
        ];
    }
    public  function messages()
    {
        return [
            'grades.*.required' => __('site.its_require'),
            'total_hours.*.required' => __('site.its_require'),
            'period_by_mounth.*.required' => __('site.its_require'),

            'grades.*.numeric' => __('site.must be a number'), 
            'total_hours.*.numeric' => __('site.must be a number'),
            'period_by_mounth.*.numeric' => __('site.must be a number'),


        ];
    }
}
