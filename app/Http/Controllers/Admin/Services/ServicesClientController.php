<?php

namespace App\Http\Controllers\Admin\Services;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServicesClientController extends Controller
{
    public function service_to_client()
    {
        $services = Service::active()->with('currency')->get();
        return view('admin.services.clienservices.index',compact('services'));
    }
}
