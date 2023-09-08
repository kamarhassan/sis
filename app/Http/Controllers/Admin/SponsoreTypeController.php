<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SponsorType;
use Illuminate\Http\Request;

class SponsoreTypeController extends Controller
{
    public   function index()
    {
        $sponsorefeetype = SponsorType::get();
        return view('admin.setup.sponsortype.index',compact('sponsorefeetype'));
    }

}
