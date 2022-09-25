<?php

namespace App\Repository\AdminNotification;

use App\Models\NotificationAdmin;
use Illuminate\Support\Facades\Request;

class AdminNotificationRepository implements AdminNotificationInterface
{

    public  function get_all_unread_notification()
    {
        return NotificationAdmin::where(['delete' => 1, 'status' => 1])->get();
    }
    public  function get_register_notification()
    {
        return NotificationAdmin::where(['delete' => 1, 'status' => 1, 'order_type' => 'registration'])
            ->with('cours_reserved', 'user')
            ->get();
    }

    public  function get_type_id_description()
    {
        return NotificationAdmin::where(['delete'=>1,'status'=>1])->get(['id','description']);
    }
    



}
