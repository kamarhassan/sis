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



    public function get_permission_for_role($role_id)
    {
        try {
            $all_permisssion = Permission::get('id');
            $roles = Role::find($role_id);
            if (!$roles) {
                return response()->json(['status' => 'error', 'message' => __('site.this role not found')]);
            }
            return response()->json([
                'status' => 'success',
                'all_permissions_id' => $all_permisssion,
                'permissions_for_role' => $roles->permissions,
                'role_id' => $role_id,
                'role_name' => $roles['name'],
            ]);
        } catch (\Throwable $th) {
            // throw $th
            return response()->json(['status' => 'error', 'message' => __('site.you site.you have error')]);
            ;
        }
    }
    public function update_permission_for_role(Request $request)
    {
// return $request;
          $permision = $request->except('role_id', '_token', 'role_name');
        try {
            $permissions_for_role =  $this->get_permission_from_request($permision);
            $role = Role::findByName($request->role_name);
            return $role->syncPermissions($permision);
            //  $role = Role::find($request->role_id);
            //  $role->givePermissionTo($permissions_for_role);
            //  $permission->syncRoles($roles);
            //  $role->givePermissionTo(['create_edit_levels','create_edit_grades','activate_currency']);
            // return   $role->syncPermissions(['create_edit_levels', 'create_edit_grades', 'activate_currency']);
        } catch (\Throwable $th) {
            throw $th;
        }
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
        $route = "#";
        $role = Role::create(['guard_name' => 'admin', 'name' => $request->role_name]);

        if (!$role) {
            $message = __('site.faild to create new role');
            $status = 'error';
        } else {
            $message = __('site.create role suucesfuly  added');
            $status = 'success';
            $route = route('admin.setting.role');
        }
        return response()->json(['status' => $status, 'message' => $message, 'route' => $route]);
    }



    public function delete_role(Request $request)
    {
        try {
            $roles = Role::find($request->id);
            if (!$roles) {
                $message = __('site.this role not defined');
                $status = 'error';
            } else {

                if ($this->role_can_delete($request->id) == false) {
                    $message = __('site.you cant delete this role beacuse it is imporatnt');
                    $status = 'error';
                } else {
                    $roles->delete();
                    $message = __('site.deleted_msg_swal_fire');
                    $status = 'success';
                }
            }
            return response()->json(['status' => $status, 'message' => $message, 'roles' => $roles]);
        } catch (\Throwable $th) {
            // throw $th;
            $message = __('site.you site.you have error');
            $status = 'error';
            return response()->json(['status' => $status, 'message' => $message, 'roles' => $roles]);

        }
    }



    private function role_can_delete($role_id)
    {
        $roles = Role::find($role_id);
        // $roles->User;
        if ($roles)
            if ($roles['name'] != "super admin" && $roles['name'] != "teacher")
                return true;
        return false;
    }
}
