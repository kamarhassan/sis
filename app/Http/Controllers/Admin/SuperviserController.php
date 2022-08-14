<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class SuperviserController extends Controller
{
    public function create(){
        $permission = Permission::get();

        return view('admin.superviser.create',compact('permission'));
    }


    public function all_role(Type $var = null)
    {
        $roles = Role::all();
        $Permission = Permission::all();
    return    $admin_with_role = Admin::with('roles')->get();
        return view('admin.superviser.create',compact('roles','Permission','admin_with_role'));
    }


   public function store(Request $request){
        return response()->json($request);
    }
}
