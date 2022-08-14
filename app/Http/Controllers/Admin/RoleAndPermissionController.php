<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionController extends Controller
{
    //$roles = \Spatie\Permission\Models\Role::all();


    public function all_role()
    {
        $roles = Role::get();

        return view('admin.role-and-permission.create', compact('roles'));
    }

    public function get_permission_for_role($role_id)
    {

        try {
            // return            $role_id;
           $roles = Role::find($role_id);
            if (!$roles){

                return response()->json(['status' => 'error', 'message' => __('site.this role not found')]);
            }

            return response()->json([
                'status' => 'success', 'permissions' => $roles->permissions,
                'role_id' => $role_id, 'role_name' => $roles['name']
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
        # code...
    }
    public function update_permission_for_role(Request $request)
    {

        $permision = $request->except('role_id', '_token', 'role_name');
        try {

            $permissions_for_role =  $this->get_permission_from_request($permision);
            // array_merge($permissions_for_role,$this->get_permission_from_request($request->cours,"cours" ));

            // $permissions_for_role = $this->get_permission_from_request($request->cours,"cours" );

            // return   $permissions_for_role;

            $role = Role::find($request->role_id);
            return   $role->syncPermissions($permissions_for_role);
            //  $role->givePermissionTo($permissions_for_role);
            //  $permission->syncRoles($roles);
            //  $role->givePermissionTo(['create_edit_levels','create_edit_grades','activate_currency']);
            // return   $role->syncPermissions(['create_edit_levels', 'create_edit_grades', 'activate_currency']);
        } catch (\Throwable $th) {
            throw $th;
        }

        //  return $roles->permissions;
        //             return response()->json(['permissions'=>$roles->permissions]);
        # code...
    }


    private function get_permission_from_request($request/*for name of all sub permission*/) {

        foreach ($request as $key => $value) {
            $permissions_for_role[] = $key;
            foreach ($value as $key1 => $value) {
                $permissions_for_role[] = $key1;
            }
        }
        return   $permissions_for_role;
    }
}
