<?php

namespace App\Http\Livewire\Admin\Grade;

use Livewire\Component;
use Livewire\Livewire;
use phpDocumentor\Reflection\Types\This;

class Addgrade extends Livewire
{
    public $grades = ['test', 'test1'];
    public function render()
    {

        return view('livewire.admin.grade.addgrade');
    }
}
