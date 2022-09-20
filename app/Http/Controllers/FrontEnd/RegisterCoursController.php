<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterCoursController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth');
   }

   public function register()
   {
   }
}
