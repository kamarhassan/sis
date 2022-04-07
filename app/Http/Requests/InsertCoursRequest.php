<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertCoursRequest extends FormRequest
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
            'grade'  => 'required|exists:grades,name',
            'level' => 'required|exists:levels,name',
            'start_date' => 'required|date',
            'end_date'    => 'required|date',

            'ac_start_date' => 'required|date|after_or_equal:start_date',
            'ac_end_date' =>   'required|date|after_or_equal:end_date',
            'status' => 'required|exists:statusofcours,name',
            'teacher_name' => 'required',
            'teacher_fee' => 'required|numeric',
            'days' =>'required|array|min:1'
        ];
    }


    public  function messages()
    {
        return [
            '*.required' => __('site.its_require'),
            'level.exists' => __('site.its_exists'),
            'grade.exists' => __('site.its_exists'),
            'status.exists' => __('site.its_exists'),
            '*.date' => __('site.cours date must be date'),
            'ac_start_date.after_or_equal' => __('site.after or equal start date'),
            'ac_end_date.after_or_equal' =>   __('site.after or equal end date'),
            'teacher_fee.numeric' => __('site.teacher fee must be number'),
        ];
    }
}
