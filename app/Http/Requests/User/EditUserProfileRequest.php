<?php

namespace App\Http\Requests\User;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EditUserProfileRequest extends FormRequest
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
      /**
       * check if id is equal auth user id
       */
      
      if ($this->password != null) {
         // dd(1);
      
         
         return [
            'id' => 'required|exists:users,id|in:' . Auth::user()->id,
            'password' => 'required_with:retype_password|same:password',
            'retype_password' => 'required',
            
            
         ];
      } else {
         // dd(2);

         return [

            'id' => 'required|exists:users,id|in:' . Auth::user()->id,
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phonenumber' => ['required', 'digits:8', 'numeric'],
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',

            'birthday' => ['required', 'date'],
            // 'born_place' => ['required'],
            'birthday_place.*' => ['required'],
           
            'birthday_place.country' => ['required', 'string', 'max:255'],
            'birthday_place.area' => ['required', 'string', 'max:255'],

         ];
      }
   }
}
