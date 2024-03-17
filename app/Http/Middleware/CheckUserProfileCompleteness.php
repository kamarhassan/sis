<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserProfileCompleteness
{
   /**
    * Handle an incoming request.
    *
    * @param \Illuminate\Http\Request $request
    * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
    * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
    */
   public function handle(Request $request, Closure $next)
   {

      $user = Auth::user();

      // Define required fields for a complete profile


      if (empty($user->firstname) || empty($user->lastname) || empty($user->email) || empty($user->phonenumber)) {
         // Redirect to the profile completion page if any required field is missing
         return redirect()->route('web.profile.must.complete');
      } 
     

      // If profile is complete and user status is approved, allow the request to proceed
      return $next($request);
   }
}
