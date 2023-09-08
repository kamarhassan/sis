<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationStudentsRequest extends FormRequest
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
//       dd($this->feerequired);
      return [
         'user_id' => 'required|exists:users,id',
         'cours_id' => 'required|exists:courss,id',
//            'feerequired.*' => 'exists:cours_fees,id',
      ];
   }
   public  function messages()
   {
      return [
         '*.required' => __('site.its_require'),
         'user_id.exists' => __('site.its_require'),
         'cours_id.exists' => __('site.its_require'),

      ];
   }
}
