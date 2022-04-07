<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
class SuperviserController extends Controller
{
    public function create(){
        $permission = Permission::get();
        return view('admin.superviser.create',compact('permission'));
    }


   public function store(Request $request){
        return response()->json($request);
    }
}
