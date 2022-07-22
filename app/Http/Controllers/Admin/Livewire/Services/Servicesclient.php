<?php

namespace App\Http\Controllers\Admin\Livewire\Services;

use App\Models\Service;
use Livewire\Component;

class Servicesclient extends Component
{
    public function render()
    {
        $services = Service::active()->with('currency')->get();
        // return view('admin.services.clienservices.index',compact('services'));
        return view('admin.livewire.services.servicesclient',compact('services'));
    }
}
