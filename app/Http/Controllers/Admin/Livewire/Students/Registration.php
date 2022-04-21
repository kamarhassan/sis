<?php

namespace App\Http\Controllers\Admin\Livewire\Students;

use Livewire\Component;

class Registration extends Component
{
    public $cur = 1;
    public function render()
    {
        return view('admin.livewire.students.registration');
    }
}
