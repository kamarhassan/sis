<?php

namespace App\Http\Middleware;

use Illuminate\Support\Str;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {


            $url_is_admin = Str::contains($request, 'admin');


            // if ($url_is_admin) {

            //     // return route('get.admin.login');
            // } else {
            //     return route('get.admin.login');
            // }
            //    else  return route('login');



            if ($url_is_admin)
                return route('get.admin.login');

            //    else if(!$request->is("*./admin/.*"))
            return route('login');
            //    else  return route('login');
        }
    }
}
