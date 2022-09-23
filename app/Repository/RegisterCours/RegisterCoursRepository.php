<?php

namespace App\Repository\RegisterCours;

use App\Models\NotificationAdmin;
use App\Models\User;

class RegisterCoursRepository implements RegisterCoursInterface
{

    public function  register_in_cours($request)
    {

        $reserveCours =  NotificationAdmin::create([
            'user_id' => $request->user_id,
            'order_id' => $request->order_id,
            'order_type' => 'registration',
            'description' => __('site.you have a new registration')
        ]);
        return $reserveCours;
    }
    public function  delete_register_in_cours($request)
    {
        $reserve = NotificationAdmin::find($request);
        if (!$reserve)
            return false;
        return $reserve->delete();
    }
    public function user_cours_reserved($user_id)
    {
        $user = User::find($user_id);
        return $user->reserved_cours;
    }
}
