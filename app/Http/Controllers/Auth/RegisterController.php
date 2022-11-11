<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'midname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'phonenumber' => ['required', 'digits:8', 'numeric'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
// private function phone_pattern($phonenumber){
//     $ph_prefix = substr($phonenumber, 0, 2);
  

//     if($ph_prefix =='04' || $ph_prefix =='05'|| $ph_prefix =='01'|| 
//     $ph_prefix =='08'|| $ph_prefix =='09'|| $ph_prefix =='08'|| $ph_prefix =='06')
// }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([

            'name' => $data['firstname'].' '.$data['midname'].' '.$data['lastname'],
            'firstname' => $data['firstname'],
            'midname' => $data['midname'],
            'lastname' => $data['lastname'],
            'phonenumber' => $data['phonenumber'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
       
        ]);
    }
}
