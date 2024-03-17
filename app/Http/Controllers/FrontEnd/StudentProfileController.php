<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repository\User\UserInterface;
use Illuminate\Support\Facades\Session;
use  Lwwcas\LaravelCountries\Models\Country;
use App\Http\Requests\User\EditUserProfileRequest;

class StudentProfileController extends Controller
{
   protected $userrepo;

   public function __construct(UserInterface $userinterface)
   {
      $this->userrepo = $userinterface;
   }

   public function index()
   {
      $user = Auth::user();

      // return $countries = Country::_all();
      $countries = Country::withTranslation()->get(['id', 'emoji', 'iso_alpha_2']);
      // $t= json_decode($countries[0]['emoji']);  
      // return ( $t->img);
      //  Country::whereIso('LB')->first();
      // Country::whereIsoAlpha3('LBN')->first();
      // Country::whereSlug('brasil')->first();

      return view('frontend.user.student-profile', compact(['user', 'countries']));
   }

   public function post(EditUserProfileRequest $request)
   {

      $is_updated = $this->userrepo->update_user_information($request->id, $request);
      if ($is_updated == 1) {
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
   public function post_password(EditUserProfileRequest $request)
   {
      //  return $request;
      $is_updated = $this->userrepo->update_user_password($request->id, $request);
      if ($is_updated == 1) {
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


   public function complete_profile()
   {
      // $user = auth()->user();
      // return view('frontend.user.profile-not-complete',compact('user'));
      // return view('frontend.user.profile-not-complete');
      return  response()->json(['route' => route('web.edit-profile.to.complete'), 'status' => 'error', 'message' => __('site.your profile is not complete')]);
   }
   

   



   public function edit_profile_complete()
   {
      // use Illuminate\Support\Facades\Session;
      $user = auth()->user();
      $countries = Country::withTranslation()->get(['id', 'emoji', 'iso_alpha_2']);
      Session::put('profile_not_complete', __('site.compelete your profile'));
      return view('frontend.user.profile-not-complete',compact('user','countries'));
  
   }


   public function save_profile_complete()
   {
   }
}
