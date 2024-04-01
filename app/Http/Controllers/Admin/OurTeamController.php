<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\OurTeam\OurTeamRequest;
use App\Models\OurTeam;
use App\Traits\Image;

class OurTeamController extends Controller
{
   use Image;
   public function index()
   {
      $teams = OurTeam::with('info:id,name')->get();
      return view('admin.our-team.our-team', compact('teams'));
   }
   public function add_team()
   {
      $admin = Admin::get();

      return view('admin.our-team.create-or-update', compact('admin'));
   }
   public function edit_team($id)
   {
      $team = OurTeam::with('info:id,name')->find($id);
      $admin = Admin::get();
      return view('admin.our-team.create-or-update', compact('team', 'admin'));
   }

   public function save_or_update_team(OurTeamRequest $request)
   {
      $userId = $request->input('instructor');
      $photo = $request->file('photo');
      $shortDescription = $request->input('shortdescription');

      // Check if the record already exists
        $ourteam = OurTeam::firstOrNew(['instructor' => $userId]);


      // Adjust the path where you want to store photos
      if ($request->photo) {
         $ourteam->photo ?  $this->removeImagefromfolder($ourteam->photo) : '';
         $ourteam->photo  = $this->saveImage($photo, 'public/files/images/ourteam');
      }
     

      $ourteam->shortdescription = $shortDescription;

      // Save the record
      $is_saved_od_updated =  $ourteam->save();



      if ($is_saved_od_updated == 1) {
         $status = 'success';
         $message = __('site.Post edit successfully!');
         $route = '#';
      } else {
         $status = 'error';
         $message = __('site.fail created successfully!');
         $route = "#";
      }
      return response()->json(['status' => $status, 'message' => $message, 'route' => $route]);
   }

   public function delete(Request $request)
   {
      try {
         $team =  OurTeam::find($request->id);

         if (!$team) {
            $status = 'error';
            $message =  __('site.you have error');
         } else {

            $is_deleted = $team->delete();
            if ($is_deleted) {
               $status = 'success';
               $message = __('site.deleted_msg_swal_fire');
            } else {
               $status = 'error';
               $message =  __('site.you have error');
            }
         }
         return response()->json(['message' => $message, 'status' => $status]);
      } catch (\Throwable $th) {
         throw $th;
      }
   }
}
