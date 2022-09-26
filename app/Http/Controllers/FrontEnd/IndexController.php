<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Cours\CoursInterface;

class IndexController extends Controller
{
    protected $cours;
    public function __construct(CoursInterface $cours)
    {
        $this->cours = $cours;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       $cours= $this->cours->open_and_postopen_cours();
         return view('frontend.index',compact('cours'));
    }
}
