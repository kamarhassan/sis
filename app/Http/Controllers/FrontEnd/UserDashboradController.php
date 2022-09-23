<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Repository\Cours\CoursInterface;
use App\Repository\RegisterCours\RegisterCoursInterface;
use Illuminate\Http\Request;

class UserDashboradController extends Controller
{
    protected $cours;
    protected $registercoursinterface;
    public function __construct(CoursInterface $cours,RegisterCoursInterface $registercoursinterface)
    {
        $this->cours = $cours;
        $this->registercoursinterface = $registercoursinterface;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       return $this->cours->open_and_postopen_cours();
        return view('frontend.dashborad.dashborad');
    }
    public function user_cours_reserved($user_id)
    {
        $user_cours = $this->registercoursinterface->user_cours_reserved($user_id);
       return  view('frontend.cours.new-user-cours',compact('user_cours'));
    }
}
