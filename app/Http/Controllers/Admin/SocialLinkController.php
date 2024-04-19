<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;

class SocialLinkController extends Controller
{
   public function index()
   {
      $socialMedia = Config::get('social_media');
    
      return view('admin.setup.social-link.index', compact('socialMedia'));
   }
   public function   update_social_link(Request $request)
   {

      // return $request;
      $socialMedia = Config::get('social_media');
    
    // Update the URL for the specified platform
   // $socialMedia[$platform] = $request->input($platform);

    // Save the updated data back to the configuration file


   

   //  Config::set('social_media', $socialMedia);
   //  Config::save('social_media');

   try {
    
      foreach ($request->except('_token') as $key => $value) {
         $socialMedia[$key] = $request->input($key);
       }  $configPath = config_path('social_media.php');
       $insert=  File::put($configPath, '<?php return ' . var_export($socialMedia, true) . ';' . PHP_EOL);
   
     if ($insert) {

      $message = __('site.Post edit successfully!');
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
      $message = __('site.wrong try again');
      $status = 'error';
      $route = '#';
      return response()->json(['status' => $status, 'message' => $message, 'route' => $route]);
   }

   }
}
