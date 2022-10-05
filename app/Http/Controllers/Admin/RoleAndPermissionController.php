<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\RoleAndPermissionRequest;

class RoleAndPermissionController extends Controller
{
    //$roles = \Spatie\Permission\Models\Role::all();

    public function __construct()
    {
      
     }
    public function all_role()
    {
        $roles = Role::get();
        $all_permisssion = Permission::get();
        $permission = $all_permisssion->groupBy([
            'tab_name',
            function ($item) {
                return $item['parent'];
            },
        ], $preserveKeys = true);
        $tab_name = Permission::distinct('tab_name')->get('tab_name');
        return view('admin.role-and-permission.create', compact('roles', 'permission', 'tab_name'));
    }
    public function get_permission()
    {
        $all_permisssion = Permission::get();
        $permission = $all_permisssion->groupBy([
            'tab_name',
            function ($item) {
                return $item['parent'];
            },
        ], $preserveKeys = true);
        $tab_name = Permission::distinct('tab_name')->get('tab_name');

        return view('admin.role-and-permission.testpermmiseion', compact('permission', 'tab_name'));
    }


    public function get_permission_for_role($role_id)
    {
        try {


            $all_permisssion = Permission::get();
            $permission = $all_permisssion->groupBy([
                'tab_name',
                function ($item) {
                    return $item['parent'];
                },
            ], $preserveKeys = true);
            $tab_name = Permission::distinct('tab_name')->get('tab_name');

            $roles = Role::find($role_id);
            if (!$roles) {
                return response()->json(['status' => 'error', 'message' => __('site.this role not found')]);
            }
            return response()->json([
                'status' => 'success',
                'permissions_for_role' => $roles->permissions,
                'role_id' => $role_id,
                'role_name' => $roles['name'],
                'permission' => $permission,
                'tab_name' => $tab_name,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
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


    private function get_permission_from_request($request/*for name of all sub permission*/)
    {

        foreach ($request as $key => $value) {
            $permissions_for_role[] = $key;
            foreach ($value as $key1 => $value) {
                $permissions_for_role[] = $key1;
            }
        }
        return   $permissions_for_role;
    }
    public function new_role(RoleAndPermissionRequest $request/*for name of all sub permission*/)
    {


        $role = Role::create(['guard_name' => 'admin', 'name' => $request->role_name]);
    return     $role->givePermissionTo($request->permission);

        return $request;
       
    }
}
