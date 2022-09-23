<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// use App\Repository\User\UserInterface;
use App\Repository\User\UserInterface;
use App\Repository\AdminNotification\AdminNotificationInterface;

class AdminNotificationController extends Controller
{
    protected $adminnotification;
    protected $userrepository;
    public function __construct(
        AdminNotificationInterface $adminnotification
        ,UserInterface $userInterface 
    ) {
        $this->userrepository = $userInterface;
        $this->adminnotification = $adminnotification;
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
    public  function user_info($user_id)
    {

        try {
            //code...
            return  $user = $this->userrepository->get_user_by_id($user_id);
        } catch (\Throwable $th) {
            //throw $th;
        }
        
    }
}
