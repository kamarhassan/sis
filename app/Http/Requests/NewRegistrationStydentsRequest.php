<?php

namespace App\Http\Requests;

use App\Models\CoursFee;
use Illuminate\Foundation\Http\FormRequest;

class NewRegistrationStydentsRequest extends FormRequest
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
      // dd($this->fee_sponsored_validate_init());
      return [
         'user_id' => 'required|exists:users,id',
         'cours_id' => 'required|exists:courss,id',
         'cours_fee' => 'required|array',
         'cours_fee.*' => 'required|exists:cours_fees,id|min:1',
         'teams_user' => $this->teams_user(),
         // 'teams_pas' => $this->teams_pas(),
         'sponsor_id' => $this->sponsor_id(),
         'sponsore_fee_type_id' => $this->sponsore_fee_type_id(),
         // 'fee_sponsored' => $this->fee_sponsored_validate_init(),
         // 'fee_sponsored.*' => $this->fee_sponsored_validate(),
      ];
   }
   public  function messages()
   {
      return [
         'cours_fee.required' => __('site.select one of fees at least'),
         '*.required' => __('site.its_require'),
         '*.email' => __('site.import email is not valid'),
         'user_id.exists' => __('site.its_require'),
         'cours_id.exists' => __('site.its_require'),

      ];
   }
   private function sponsor_discount()
   {
      if ($this->it_has_discount == 'with_discount')
         return 'required|numeric|min:1|max:' . $this->MaxDiscount();
      return '';
   }
   private function sponsor_precentage()
   {
      if ($this->it_has_discount == 'with_discount')
         return 'required|numeric|min:1|max:100';
      return '';
   }
   private function sponsor_id()
   {
      if ($this->it_has_discount == 'with_discount')
         return 'required|exists:sponsors,id';
      return '';
   }
   private function sponsore_fee_type_id()
   {
      if ($this->it_has_discount == 'with_discount')
         return 'required|exists:sponsor_types,id';
      return '';
   }

   private function MaxDiscount()
   {
      // if (count($this->fee_sponsored) >= 1)
      return CoursFee::WhereIn('id', $this->fee_sponsored)->sum('value');
   }


   private function teams_user()
   {
      if ($this->teams_user == null)
         return "";
      else return 'required|max:255|email';
   }
   private function teams_pas()
   {
      if ($this->teams_user == null)
         return "";
      else return 'required|max:255';
   }
}
