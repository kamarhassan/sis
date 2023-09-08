<?php

namespace App\Repository\User;

use Carbon\Carbon;
use App\Models\User;
use App\Traits\Image;
use App\Repository\User\UserInterface;

class UserRepository implements UserInterface
{
   use Image;
   public function get_user_by_id($user_id)
   {
      $user = User::find($user_id);
      if (!$user)
         return false;
      return $user;
   }
   public function update_user_information($user_id, $request)
   {
      // return  $request;

       $user = User::find($user_id);
      if ($request->has('photo')) {
         $this->removeImagefromfolder( $user->photo);
          $user->photo = $this->saveImage($request->photo, 'public/files/images/user');
     }
     
     $user->name =  $request->firstname . ' ' . $request->midname . ' ' . $request->lastname;
     $user->firstname =  $request->first_name;
     $user->firstname =  $request->middle_name;
     $user->lastname =  $request->last_name;
     $user->updated_at =  Carbon::now();
     $user->email =  $request->email;
     $user->phonenumber =  $request->phonenumber;
     $user->birthday =  $request->birthday;
     $user->birthday_place = $request->birthday_place;

    return $updated = $user->save();

   }



   public function update_user_password($user_id, $request)
   {
      // return  $request;

      $user = User::find($user_id);
     
      
      $user->password = bcrypt($request->password);

      return $updated = $user->save();

   }
   
}
