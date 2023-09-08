<?php

namespace App\Repository\User;

interface UserInterface
{
    public function get_user_by_id($user_id);
    public function update_user_information($user_id,$request);
   public function update_user_password($user_id, $request);
}
