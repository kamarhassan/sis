<?php

namespace App\Repository\AdminNotification;

interface AdminNotificationInterface
{
    public  function get_all_unread_notification();
    public  function get_register_notification();
    public  function get_type_id_description();
    public  function delete_notification($array_of_id);
    public  function reading_notification($array_of_id);
    public  function deny_all_notification($array_of_id);
    public  function approve_all_notification($array_of_id);
}
