<?php

namespace App\Http\Controllers\Admin\Livewire\PayFeeCours;

use Livewire\Component;

class Payment extends Component
{


    protected $listeners = ['payment_pro'];
    public function render()
    {
        return view('admin.livewire.pay-fee-cours.payment');
    }
    public function mount()
    {
        $this->registre_id = 0;
    }






    public function payment_pro()
    {

        return redirect()->route('admin.students.Registration-1');
    }
}
