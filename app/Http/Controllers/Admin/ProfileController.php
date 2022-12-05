<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Admin;
use App\Traits\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateInfoAdminRequest;

class ProfileController extends Controller
{
    use Image;
    public function index()
    {
        $admin_info =  Admin::find(Auth::id());

        return view('admin.info.profile', compact('admin_info'));
    }
    public function update_info(UpdateInfoAdminRequest $request)
    {
        try {
            $route = "#";

           $admin_logged =   Admin::find(Auth::id());
            if (!$admin_logged) {
                $status = 'error';
                $message = __('site.you have error');
            } else {

                if ($request->has('photo')) {
                    $this->removeImagefromfolder($admin_logged->photo);
                    $admin_logged->photo = $this->saveImage($request->photo, 'public/images/admin');
                }

                if ($request->has('password'))
                    $admin_logged->password = bcrypt($request->password);

                $admin_logged->name =  $request->first_name . ' ' . $request->middle_name . ' ' . $request->last_name;
                $admin_logged->first_name =  $request->first_name;
                $admin_logged->middle_name =  $request->middle_name;
                $admin_logged->last_name =  $request->last_name;
                $admin_logged->updated_at =  Carbon::now();
                $admin_logged->email =  $request->email;

                $updated = $admin_logged->save();

                if ($updated ) {
                    $status = 'success';
                    $message = __('site.success update password');
                    $route = route('admin.profile');
                } else {
                    $status = 'error';
                    $message = __('site.faild update password');
                }
            }
            return response()->json(['status' => $status, 'message' => $message, 'route' => $route]);
        } catch (\Throwable $th) {
            // throw $th;
            $status = 'error';
            $message = __('site.you site.you have error');
            $route = "#";
            return response()->json(['status' => $status, 'message' => $message, 'route' => $route]);
        }

        // $roles = Role::all();
        // $admin_info = Admin::find($request->admin_id);
        // return view('admin.superviser.edit', compact('roles', 'admin_info'));
    }
}
