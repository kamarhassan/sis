<?php

namespace App\Repository\AdminNotification;

use App\Models\NotificationAdmin;
use Illuminate\Support\Facades\Request;

class AdminNotificationRepository implements AdminNotificationInterface
{

    public  function get_all_unread_notification()
    {
        return NotificationAdmin::where(['delete' => 1, 'is_read' => 1])->get();
    }

    public  function get_register_notification()
    {
        return NotificationAdmin::where(['delete' => 1, 'order_type' => 'registration'])
            ->with('cours_reserved', 'user')
            ->get();
    }

    public  function get_type_id_description()
    {
        return NotificationAdmin::where(['delete' => 1, 'is_read' => 1])->get(['id', 'description']);
    }

    public  function delete_notification($array_of_id)
    {
        
        $selected = NotificationAdmin::whereIn('id', $array_of_id)->get();
        if ($selected->count() > 0) {
            $updated = NotificationAdmin::whereIn('id', $array_of_id)->delete();
            if ($updated)
                return true;
            return false;
        }
        return false;
    }

    public  function reading_notification($array_of_id){
          $array_of_id;
        $selected = NotificationAdmin::whereIn('id', $array_of_id)->get();
        if ($selected->count() > 0) {
            $updated = NotificationAdmin::whereIn('id', $array_of_id)->update(['is_read' => 0]);
            if ($updated)
                return true;
            return false;
        }
        return false;
    }



    public  function deny_all_notification($array_of_id){
        $selected = NotificationAdmin::whereIn('id', $array_of_id)->get();
        if ($selected->count() > 0) {
            $updated = NotificationAdmin::whereIn('id', $array_of_id)->update(['status' => 0]);
            if ($updated)
                return true;
            return false;
        }
        return false;
    }
    public  function approve_all_notification($array_of_id){
        $selected = NotificationAdmin::whereIn('id', $array_of_id)->get();
        if ($selected->count() > 0) {
            $updated = NotificationAdmin::whereIn('id', $array_of_id)->update(['status' => 1]);
            if ($updated)
                return true;
            return false;
        }
        return false;
    }
}
