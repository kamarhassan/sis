<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

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
      $user = auth()->user();

      if (auth()->check() && $user->firstname != "" &&
         $user->midname != "" &&
         $user->lastname != "" &&
         $user->email != "" &&
         $user->phonenumber != "") {
         return $next($request);
      }

      // Redirect the user to complete their profile
      return redirect()->route('web.profile.edit');
   }
}
