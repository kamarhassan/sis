<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class loginController extends Controller
{
    public function getlogin()
    {
        return view('admin.auth.login');
    }

    public function login(LoginRequest $request)
    {
        // faker filler password        1234
        $remember_me = $request->has('remember_me') ? true : false;
        try {
            if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
                // return $request;
                toastr()->success(__('site.login succes'));
                $request->session()->put('admin_name', Auth::guard('admin')->user()->name);
    
                Session::put('mode', 'dark');
                
                return redirect()->route('admin.dashborad');
            }
            return redirect()->route('get.admin.login');
        } catch (\Throwable $th) {
            throw $th;
        }
    
        // notify()->error('خطا في البيانات  برجاء المجاولة مجدا ');
        // toastr()->error(__('site.you have error'));
        // return redirect()->back();
    }
    public function logout()
    {
        // return 1;
        // Auth::guard('admin')->logout();
        if (Auth::guard('admin')->check()) // this means that the admin was logged in.
        {
            Auth::guard('admin')->logout();
            return redirect()->route('get.admin.login');
        }

        $this->guard()->logout();
        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }

    // public function save()
    // {
    //     $admin = new App\Models\Admin();
    //     $admin -> name ="hassan kamar";
    //     $admin -> email ="hassankamar799@gmail.com";
    //     $admin -> password = bcrypt("123456789");
    //     $admin -> save();
    // }
    public function change_password()
    {
        return "change passwor is mandatory";
    }
}
