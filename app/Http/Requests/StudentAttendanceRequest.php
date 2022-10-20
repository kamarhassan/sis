<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentAttendanceRequest extends FormRequest
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
            'cours_id' => 'required|exists:courss,id',
            'attendance_date' => 'date|after_or_equal:min_date|before_or_equal:max_date'
        ];
    }
    public  function messages()
    {
        return [
            '*.required' => __('site.its_require'),
            '*.before_or_equal' => __('site.date is not valid date should be between start and end date for take attendance'),
            '*.after_or_equal' => __('site.date is not valid date should be between start and end date for take attendance'),
        ];
    }
}
