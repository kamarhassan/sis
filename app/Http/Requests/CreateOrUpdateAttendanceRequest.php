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
        $attandance_validate = $this->attendance_validate($this->total_hours_details);
        return [
            'techear_id' => 'required|exists:admins,id',
            'cours_id' => 'required|exists:courss,id',
            'attendance_date_new_or_update' => 'required|date',
            'total_hours_details' => 'required|numeric|min:1',
            'attendance.*' . $attandance_validate['id'] => $attandance_validate['attendance_error'], // 'integer|max:' . $this->total_hours_details,
        ];
    }

    public function messages()
    {
        return [
            '.*.required' => __('site.its_require'),
            // '.*.numeric' => __('site.must be a number'),
            'attendance.*.max' => __('site.max number of hours for attendance') . " " . $this->total_hours_details,
            'attendance.*.min' => __('site.min number of hours for attendance')
        ];
    }
    private function attendance_validate($nb_hours)
    {
        foreach ($this->attendance as $key => $value) {
            if ($value != null) {
                if (!is_numeric($value))
                    return   ['id' => $key, 'attendance_error' => 'numeric|max:' . $nb_hours];
                else if ($value > $nb_hours)
                    return   ['id' => $key, 'attendance_error' => 'numeric|max:' . $nb_hours];
                else if ($value <= 0)
                    return   ['id' => $key, 'attendance_error' => 'numeric|min:1'];
            }
        }
        return   ['id' => '', 'attendance_error' => ''];
    }
}
