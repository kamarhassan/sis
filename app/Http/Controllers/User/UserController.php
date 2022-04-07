<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;
class UserController extends Controller
{   use HasRoles;
    // apache_request_headers

    public function FunctionName()
    {
        // User->get()->all();


    }


    public function index()
    {
        // $users = User"""

    }

    public function create()
    {
        return view('admin.Users.create');
    }
}
