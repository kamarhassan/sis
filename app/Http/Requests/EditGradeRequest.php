<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditGradeRequest extends FormRequest
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
//      dd($this->grades);
      return [
         'grades' => 'required|max:255',
         'category_id' => 'required|exists:grades,id',


      ];
   }
   public  function messages()
   {
      return [
         '*.required' => __('site.its_require'),

         'id.exists' =>__('site.you have error refresh and try again'),
      ];
   }
}
