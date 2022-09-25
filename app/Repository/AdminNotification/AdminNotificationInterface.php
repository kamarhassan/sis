<?php

namespace App\Repository\AdminNotification;

interface AdminNotificationInterface
{
public  function get_all_unread_notification();
public  function get_register_notification();
public  function get_type_id_description();

}
