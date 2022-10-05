<?php

namespace App\Repository\RegisterCours;

use App\Models\NotificationAdmin;
use App\Models\StudentsRegistration;
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
    public function registration_user_in_cours($request,$cours_fee_total)
    {

        try {
            $succes_std_regi = StudentsRegistration::create([
                'user_id' => $request->user_id,
                'cours_id' => $request->cours_id,
                'notes' => $request->fee_note,
                'feesRequired' => array_to_string($request->feerequired),
                'cours_fee_total' => $cours_fee_total,
                'remaining' => $cours_fee_total,
            ]);

            if ($succes_std_regi) {
                return  $succes_std_regi;
            } else return false;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
