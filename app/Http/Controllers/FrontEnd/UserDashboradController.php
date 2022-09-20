<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Repository\Cours\CoursInterface;
use Illuminate\Http\Request;

class UserDashboradController extends Controller
{
    protected $cours;
    public function __construct(CoursInterface $cours)
    {
        $this->cours = $cours;
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
}
