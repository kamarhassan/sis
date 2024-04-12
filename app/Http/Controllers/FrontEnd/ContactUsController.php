<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Models\InstitueInformation;
use App\Http\Controllers\Controller;
use App\Http\Requests\FrontEnd\ContactUs\ContactUsRequest;
use App\Models\ContactUs ;

class ContactUsController extends Controller
{
   public function index()
   {
      $institueInformation = InstitueInformation::first();
      return view('frontend.contact-us.contact-us', compact('institueInformation'));
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
