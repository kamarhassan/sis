<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInfoAdminRequest extends FormRequest
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
        // dd($this->first_name);
        return [
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:admins,email,' . $this->id,
            'role' => $this->validate_role(),
            'photo' => $this->validate_photo(),
        ];
    }


    private function validate_role()
    {
        if ($this->role!='')
            return  'required|exists:roles,name';
        return "";
    }
    private function validate_photo()
    {
        if ($this->photo!="")                                             
            return  'image|mimes:jpg,jpeg,png,gif';                                            
        return "";                                            
    }                                            
}
