<?php

namespace App\Http\Controllers\Admin\Services;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServicesRequest;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function create()
    {
        return view('admin.services.services.create' );
    }

    public function store(ServicesRequest $request)
    {
        # code...
        return $request;
    }
}
