<?php

namespace App\Repository\AdminNotification;

use App\Models\NotificationAdmin;
 
class AdminNotificationRepository implements AdminNotificationInterface
{

    public  function get_all_unread_notification(){
        return NotificationAdmin::where(['delete'=>0,'status'=>1])->get() ;
    }
    public  function get_register_notification(){
        return NotificationAdmin::where(['delete'=>0,'status'=>1,'order_type'=>'registration'])
        ->with('cours_reserved','user')
        ->get() ;
    }



}
