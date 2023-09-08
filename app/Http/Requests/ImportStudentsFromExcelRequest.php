<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportStudentsFromExcelRequest extends FormRequest
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
      // $cours_id = decrypt($this->cours_id);
      return [
         'cours_id' => 'required|exists:courss,id',
         'std_import' => 'required|mimes:xlsx,csv',
         'sponsore_id' => $this->sponsore_id(),
      ];
   }
   public  function messages()
   {
      return [
         '*.required' => __('site.its_require'),
         '*.exists' => __('site.its_exists'),
         '*.mimes' => __('site.must be xlsx or csv file'),

      ];
   }


   private function sponsore_id()
   {
      if ($this->sponsore_id != null)
         return 'required|exists:sponsors,id';
      return '';
   }
}
