<?php

namespace App\Http\Middleware\Admin;

use Closure;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasswordIsChanged
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        // $urlPrevious = url()->previous();
        $loged = Admin::find(Auth::id());
        if ($loged->passwordischanged == 0) {
            return redirect()->route('admin.change.password.mandatory');
            // dd( $loged->passwordischanged);
        }
        return $next($request);
        // else return redirect()->route($urlPrevious);
    }
}
