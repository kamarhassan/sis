<?php

namespace App\Http\Requests\Marks;

use App\Models\Cours;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Foundation\Http\FormRequest;

class StoreMarksGeneralInfoRequest extends FormRequest
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

         'marks_name' => 'required|array',
         'marks_name.*' => 'string|max:255',

         'marks' => 'required|array',
         'marks.*' => 'numeric|min:1',

         'percent' => 'required|array',
         'percent.*' => 'numeric|min:1|max:100',
      ];
   }

   private function valiadateCourseId()
   {

      if (!Cours::find(Crypt::decryptString($this->cours_id))) {
         return 'required|exists:courss,id';
      }
      return '';
   }
   public  function messages()
   {
      return [
         '*.required' => __('site.its_require'),
         'percent.*.min' =>__('site.must be a number positive min 1'),
         'percent.*.max' =>__('site.must be less than').' 100',
         'marks.*.min' =>__('site.must be greater than') ." 1",
      ];
   }
}
