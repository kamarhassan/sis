<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\OurTeam;
use Illuminate\Http\Request;


class OurTeamController extends Controller
{
   public function index(){

         $teams = OurTeam::with('info:id,name')->get();

      return view('frontend.our-team.our-team',compact('teams'));
    }
}
