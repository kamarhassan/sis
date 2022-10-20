<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrUpdateAttendanceRequest extends FormRequest
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
            'techear_id' => 'required|exists:admins,id',
            'cours_id' => 'required|exists:courss,id',
            'attendance_date_new_or_update' => 'required|date',
            'total_hours_details' => 'required|numeric',
            'attendance.*' => 'max:'.$this->total_hours_details,
        ];
    }
    public  function messages()
    {
        return [
            '*.required' => __('site.its_require'),
            '*.numeric' => __('site.must be a number'),
            '*.max' =>__('site.max number of hours for attendance')
        ];
    }
}
