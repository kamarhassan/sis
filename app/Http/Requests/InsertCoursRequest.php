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

    protected function prepareForValidation()
    {

        if ($this->get('fee') != null)
            $this->merge([
                'fee_id' => array_keys($this->get('fee'))
            ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'description'  => 'required',
            'grade'  => 'required|exists:grades,grade',
            'level' => 'required|exists:levels,level',
            'start_date' => 'required|date',
            'end_date'    => 'required|date',
            'ac_start_date' => 'required|date|after_or_equal:start_date',
            'ac_end_date' =>   'required|date|after_or_equal:end_date',
            'status' => 'required|exists:statusofcours,name',
            'teacher_name' => 'required|exists:admins,name',
            'teacher_fee' => 'required|numeric',
            'days' => 'required|array|min:1',
            'days.*' => 'numeric',
            'cours_currency' => 'required|exists:currencies,id',

            'fee' => 'array',
            'fee.*' => 'numeric|min:0',
            'fee_id.*' => 'integer|exists:fee_types,id',
        ];
    }


    public  function messages()
    {
        return [
            '*.required' => __('site.its_require'),
            '*.exists' => __('site.its_exists'),
            'level.exists' => __('site.its_exists'),
            'grade.exists' => __('site.its_exists'),
            'status.exists' => __('site.its_exists'),
            '*.date' => __('site.cours date must be date'),
            'ac_start_date.after_or_equal' => __('site.after or equal start date'),
            'ac_end_date.after_or_equal' =>   __('site.after or equal end date'),
            'teacher_fee.numeric' => __('site.teacher fee must be number'),
            'days.*.numeric' => __('site.its_exists'),
            'fee.*.numeric' => __('site.must be a number'),
            'fee.*.min' => __('site.must be a number positive'),

            'fee_id' => __('site.only select'),
            'fee_id.*' => __('site.its_exists'),

        ];
    }
}
