<?php

namespace App\Http\Controllers\Admin;

use Admin;
use App\Traits\Image;
use Illuminate\Http\Request;
use App\Models\NotificationAdmin;

use App\Http\Controllers\Controller;
use App\Repository\User\UserInterface;

use App\Repository\Cours\CoursInterface;
use App\Repository\Cours_fee\CoursfeeInterface;
use App\Repository\AdminNotification\AdminNotificationInterface;
use GrahamCampbell\ResultType\Success;

class AdminNotificationController extends Controller
{
    use Image;



    protected $coursfee;
    protected $adminnotification;
    protected $userrepository;
    protected $coursrepository;
    protected $coursfeerepository;

    public function __construct(

        CoursFeeInterface $coursfee,
        AdminNotificationInterface $adminnotification,
        UserInterface $userInterface,
        CoursInterface $coursinterface

    ) {

        $this->userrepository = $userInterface;
        $this->coursrepository = $coursinterface;
        $this->adminnotification = $adminnotification;
        // $this->coursfeerepository = $coursfee;
        $this->coursfeerepository = $coursfee;
    }

    public  function all()
    {
    }

    public  function new_register()
    {
        try {
            $new_order_registeration =   $this->adminnotification->get_register_notification();
            return view('admin.notification.new-registration', compact('new_order_registeration'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public  function user_info_with_cours($order_id)
    {

        try {
            $order = NotificationAdmin::find($order_id);
            $user = $this->userrepository->get_user_by_id($order['user_id']);
            $cours_info = $this->coursrepository->is_defined($order['order_id']);

            if ($order && $user && $cours_info) {

                $user_info = [
                    'img_profile'      => photos_dir($user['photo']),
                    'full_name'    => $user['name'],
                    'user_mail'    => $user['email'],
                    'user_Phone'     => $user['phonenumber']
                ];

                $cours_details = [
                    'start_date' => $cours_info['act_StartDa'],
                    'end_date' => $cours_info['act_EndDa'],
                    'days' => $cours_info['days'],
                    'teacher_name' => $cours_info->teacher_name['name'],
                    'grade' => $cours_info->grade,
                    'level' => $cours_info->level,
                ];

               

                $cours_fee = $this->coursfeerepository->cours_fee_with_type($cours_info);
                $total_cours_fee = $cours_fee->sum('value');
                return response()->json([
                    'status'=>'success',
                    'user_info' => $user_info,
                    'cours_details' => $cours_details,
                    'cours_fee' => $cours_fee,
                    'total_cours_fee' => $total_cours_fee
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public  function delete_marked(Request $request)
    {
        return $request;
        // return NotificationAdmin::where(['delete'=>1,'status'=>1])->get(['id','description']);
    }


}
