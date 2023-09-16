<?php

namespace App\Http\Requests\Certificate;

use Illuminate\Foundation\Http\FormRequest;

class GenerateCertificateRequest extends FormRequest
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
         'cours_id' => 'required|exists:courss,id',
         'registration_id' => 'required|exists:studentsregistrations,id',
         'template_id' => 'required|exists:certeficate_templates,id',
         'user_id' => 'required|exists:users,id',
      ];
   }
   public  function messages()
   {
       return [
           '*.required' => __('site.its_require'),
           '*.exists' => __('site.its_exists'),
           

       ];
   }
}
