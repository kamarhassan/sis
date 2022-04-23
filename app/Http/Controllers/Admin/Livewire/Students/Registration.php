<?php

namespace App\Http\Controllers\Admin\Livewire\Students;

use App\Models\Cours;
use Livewire\Component;
use App\Models\CoursFee;
use App\Repository\Cours\CoursInterface;

use function PHPUnit\Framework\isEmpty;

class Registration extends Component
{
    public $current_step = 1;
    public $cours_id;
    public $cours_ = "";
    public $cours_fee = [];
    public $select_cours;
    public $std_name = "";
    public $cours_fee_count;
    public $cours_fee_sum;


    protected $coursI;


    public function mount()
    {
        $this->select_cours = null;
        $this->cours_fee_count = -1;
    }

    public function render()
    {
        // if ($this->cours_id != "")

        $cours_ = Cours::Selection_with_grade_level();
        return view('admin.livewire.students.registration', [
            'cours' => $cours_
        ]);
    }
    public function callFunction()
    {
        $this->current_step++;
    }
    public function  one($cours_id)
    {

        $this->cours_fee_count = 0;
        // return CoursFee::Where(['cours_id'=>22])->get();
        if (CoursFee::Where(['cours_id' => $cours_id])->count() > 0) {

            $this->select_cours = $cours_id;

            $this->cours_fee = CoursFee::with(['currency', 'fee_type'])->Where(['cours_id' => $cours_id])->get();
            // $sum = Product::sum('price');
            $this->cours_fee_sum = $this->cours_fee->sum('value');

            // dd($this->cours_fee);

            if (!$this->cours_fee->isEmpty())
                $this->cours_fee_count = $this->cours_fee->count();

            // dd($this->cours_fee_count);
        }

        // dd($this->cours_fee[0]->currency['currency']);
        // $cours_ = Cours::find($value);
        // $cours_ = $this->coursI->is_defined($value);
        // $cours   _ = Cours::with(['grade','level'])->find($cours_id);
        // $cours_g=   $cours_->grade;
        // $cours_l =  $cours_->level;

        // $cours_m = $cours_->merge($cours_g);
        // dd($cours_);

        // $this->cours_id = Cours::all();
    }
}
