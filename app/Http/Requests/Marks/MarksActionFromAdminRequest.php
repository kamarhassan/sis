<?php

namespace App\Http\Requests\Marks;

use App\Models\Cours;
use App\Models\HeaderMarks;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Foundation\Http\FormRequest;

class MarksActionFromAdminRequest extends FormRequest
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
         'cours_id' => $this->valiadateCourseId(),
         'header_marks_id' => $this->valiadateHeadMarks(),
        ];
    }


    private function valiadateCourseId()
   {

      if (!Cours::find(Crypt::decryptString($this->cours_id))) {
         return 'required|exists:courss,id';
      }
      return '';
   }
    private function valiadateHeadMarks()
   {

      if (!HeaderMarks::find(Crypt::decryptString($this->header_marks_id))) {
         return 'required|exists:header_marks,id';
      }
      return '';
   }
}
