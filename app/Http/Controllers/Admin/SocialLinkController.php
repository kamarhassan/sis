<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class SocialLinkController extends Controller
{
   public function index()
   {
      $social_link = config('sociallink');
      
      return view('admin.setup.social-link.index', compact('social_link'));
   }
   public function   update_social_link(Request $request)
   {
   }
}
