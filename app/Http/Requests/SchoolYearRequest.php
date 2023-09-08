<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchoolYearRequest extends FormRequest
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
         'start_date' => 'required|date',
         'end_date' => 'required|date|after_or_equal:start_date',
      ];
   }



   public  function messages()
   {
      return [
         '*.required' => __('site.its_require'),
         '*.date' => __('site.cours date must be date'),
         '*.after_or_equal' => __('site.after or equal start date'),
      ];
   }
   
}
