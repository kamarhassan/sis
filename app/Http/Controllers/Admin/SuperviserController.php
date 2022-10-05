<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\CreateSuppervisorRequest;
use App\Http\Requests\ChanePasswordFirstLoggedRequest;
use App\Traits\Image;

class SuperviserController extends Controller
{
    use Image;
    public function __construct()
    {
    }
    public function create()
    {
        $roles = Role::get();
        return view('admin.superviser.create', compact('roles'));
    }


    public function all_role(Type $var = null)
    {
        $roles = Role::all();
        $Permission = Permission::all();
        $admin_with_role = Admin::with('roles')->get();
        return view('admin.superviser.create', compact('roles', 'Permission', 'admin_with_role'));
    }
    public function all()
    {
        $roles = Role::all();

        // return $admin_with_role = Admin::with('roles')->get();
        $admin_with_role = Admin::with('roles:id,name')->get()->except(Auth::id());
        //   return  $admin_with_role[19]['roles'][0]['name'];

        return view('admin.superviser.all', compact('roles', 'admin_with_role'));
    }


    public function store(CreateSuppervisorRequest $request)
    {

        try {
            DB::beginTransaction();

            //  return $request;
            if ($request->has('photo'))
                $file_name = $this->saveImage($request->photo, 'public/images/admin');
            else $file_name = "";
            $admin_create =   Admin::create([
                'name' => $request->first_name . ' ' . $request->middle_name . ' ' . $request->last_name,
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'photo' => $file_name,
                'admin_status' => '1',

            ])->assignRole($request->role);

            if ($admin_create) {
                $status = 'success';
                $message = __('site.admin create succes');
                $route = route('admin.supervisor.all');
            } else {
                $status = 'error';
                $message = __('site.admin create fail');
                $route = "#";
            }
            DB::commit();
            return response()->json(['status' => $status, 'message' => $message, 'route' => $route]);
            // return response()->json($request);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function delete_supervisor(Request $request)
    {
        try {
            $admin = Admin::find($request->id);

            if (empty($admin->cours)) {
                // return 'can delete ';
                $deleted = $admin->delete();
                if ($deleted) {
                    $status = 'success';
                    $message = __('site.account deleted');
                } else {
                    $status = 'error';
                    $message = __('site.account not deleted');
                }
            } else {
                // return 'have cour cant delet deactivate only';
                $status = 'error';
                $message = __('site.account can\'t beacuse it has cours');
            }
            return response()->json(['status' => $status, 'message' => $message]);
            //code...
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function change_password()
    {
        // $roles = Role::get();
        $admin_logged =  Admin::find(Auth::id());
        return view('admin.superviser.change-password', compact('admin_logged'));
    }
    public function edit_password_first_logged(ChanePasswordFirstLoggedRequest $request)
    {
        try {
            $route = "#";

            $admin_logged =  Admin::find(Auth::id());
            if (!$admin_logged) {
                $status = 'error';
                $message = __('site.you have error');
            } else {


                $updated =   $admin_logged->update([
                    'password' => bcrypt($request->password),
                    'passwordischanged' => 1,
                ]);
                if ($updated) {
                    $status = 'success';
                    $message = __('site.success update password');
                    $route = route('admin.dashborad');
                }
            }
            return response()->json(['status' => $status, 'message' => $message, 'route' => $route]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }




    public function edit(Request $request)
    {
        $roles = Role::all();
        $admin_info = Admin::find($request->admin_id);
        return view('admin.superviser.edit', compact('roles', 'admin_info'));
    }

    public function update_info(Request $request)
    {

        // return $request;
        try {
            $route = "#";

            $admin_logged =  Admin::find($request->id);
            if (!$admin_logged) {
                $status = 'error';
                $message = __('site.you have error');
            } else {
                if (!$request->has('admin_status')) {
                    $admin_status = 0;
                } else {
                    $admin_status = 1;
                }
                if ($request->has('photo'))
                    $file_name = $this->saveImage($request->photo, 'public/images/admin');
                else $file_name = "";

                $updated =   $admin_logged->update([
                    'name' => $request->first_name . ' ' . $request->middle_name . ' ' . $request->last_name,
                    'first_name' => $request->first_name,
                    'middle_name' => $request->middle_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'photo' => $file_name,
                    'admin_status' => $admin_status,
                ]);
                if ($updated) {
                    $status = 'success';
                    $message = __('site.success update password');
                    $route = route('admin.dashborad');
                }
            }
            return response()->json(['status' => $status, 'message' => $message, 'route' => $route]);
        } catch (\Throwable $th) {
            throw $th;
        }

        $roles = Role::all();
        $admin_info = Admin::find($request->admin_id);
        return view('admin.superviser.edit', compact('roles', 'admin_info'));
    }

    public function acount_inactive(){
        return view('admin.auth.acount-inactive');
    }
}
