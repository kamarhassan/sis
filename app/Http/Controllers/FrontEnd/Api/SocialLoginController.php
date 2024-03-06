<?php

namespace App\Http\Controllers\FrontEnd\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
   public function redirecttogoogle()
   {
      return Socialite::driver('google')->redirect();
   }
   public function redirecttofacbook()
   {
      return Socialite::driver('facebook')->redirect();
   }
   public function handleGooglecallback()
   {
      try {
         $user = Socialite::driver('google')->user();
         $finduser = User::where('social_id', $user->id)->first();

         if ($finduser) {
            Auth::login($finduser);
            return response()->json($finduser);
         } else {

            $newusers = User::create([

               'name' => $user->name,
               'firstname' => '',
               'midname' => '',
               'lastname' => '',
               'email' => $user->email,
               'password' => Hash::make('1234'),
               'social_id' => $user->id,
               'social_type' => 'google',
               'email_verified_at' => Carbon::now(),

            ]);
            Auth::login($newusers);
            return redirect()->route('web.dashboard');
         }
      } catch (\Throwable $th) {
         throw $th;
      }
   }
}
