<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\ContactUs ;
use Illuminate\Http\Request;
use App\Models\InstitueInformation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\FrontEnd\ContactUs\ContactUsRequest;

class ContactUsController extends Controller
{
   public function index()
   {
      $institueInformation = InstitueInformation::first();
      $socialMedia = Config::get('social_media');
      return view('frontend.contact-us.contact-us', compact('institueInformation','socialMedia'));
   }
   public function save(ContactUsRequest $request)
   {
     // return $request;
      try {
         $insert =    ContactUs::create([
         'name' => $request->name,
         'email' =>$request->email,
         'subject' =>$request->subject,
         'message' =>$request->message,
         'phone' =>$request->phone,
        ]);


        if ($insert) {

         $message = __('site.Post created successfully!');
         $status = 'success';
         $route = '#';
      } else {
         $message = __('site.wrong try again');
         $status = 'error';
         $route = '#';
      }

      return response()->json(['status' => $status, 'message' => $message, 'route' => $route]);
      } catch (\Throwable $th) {
         //throw $th;

        
      }
   }
}
