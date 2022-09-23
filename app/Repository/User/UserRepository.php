<?php

namespace App\Repository\User;

use App\Models\User;
use App\Repository\User\UserInterface;




class UserRepository implements UserInterface
{
    public function get_user_by_id($user_id)
    {
        $user = User::find($user_id);
        if (!$user)
            return false;
        return $user;
    }
}
