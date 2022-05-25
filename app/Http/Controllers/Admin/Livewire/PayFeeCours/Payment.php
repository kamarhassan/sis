<?php

namespace App\Http\Controllers\Admin\Livewire\PayFeeCours;


use Livewire\Component;
use App\Models\StudentsRegistration;

class Payment extends Component
{


    protected $listeners = ['payment_pro'];

    public $registre_id;


    public function mount( )
    {


    }

    public function render()
    {
       dd($this->registre_id);
        $std =  StudentsRegistration::find($this->registre_id);
        // dd($std);
        return view('admin.livewire.pay-fee-cours.payment');
    }






    public function payment_pro()
    {

        return redirect()->route('admin.students.Registration-1');
    }
}
