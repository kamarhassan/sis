<?php

namespace App\Repository\AdminNotification;

use Illuminate\Database\Eloquent\Model;

interface AdminNotificationInterface
{
    
    public  function get_all_unread_notification($model);
    public  function get_register_notification($model);
    public  function low_stock($model);
    public  function get_type_id_description($model);
    public  function delete_notification($model,$array_of_id);
    public  function reading_notification($model,$array_of_id);
    public  function deny_all_notification($model,$array_of_id);
    public  function approve_all_notification($model,$array_of_id);
}
