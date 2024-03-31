<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OurTeamController extends Controller
{
   public function index(){
      return view('frontend.our-team.our-team');
    }
}
