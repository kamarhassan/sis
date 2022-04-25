<?php

namespace App\Http\Controllers\Admin\Livewire\Students;

use App\Models\Cours;
use Livewire\Component;
use App\Models\CoursFee;
use App\Models\StudentsRegistration;
use App\Models\User;
use App\Repository\Cours\CoursInterface;

use function PHPUnit\Framework\isEmpty;

class Registration extends Component
{
    public $current_step = 1;
    public $cours_id;
    public $cours_ = "";
    public $cours_fee = [];
    public $select_cours;
    public $std_name;
    public $std_selected;
    public $cours_fee_count;
    public $cours_fee_sum;
    public $all_std_as_std_name;


    protected $coursI;


    public function mount()
    {
        $this->select_cours = null;
        $this->cours_fee_count = -1;
        $this->std_name = "";
        $this->std_selected = "";
        $this->all_std_as_std_name = [];
    }


    // protected $rules = [
    //     'std_name' => 'required|exists:Admins,name',
    //     'select_cours' => 'required|exists:courss,is',

    // ];

    // protected $messages = [
    //     'std_name.required' => __('site.its_require')
    //     // 'email.email' => 'The Email Address format is not valid.',
    // ];

    // public function updated($propertyName)
    // {
    //     $this->validateOnly($propertyName,[
    //         'std_name' => 'required|exists:Admins,name',
    //     ]);
    // }





    public function save_std_register()
    {

        $rules = [
            'std_name' => 'required|exists:Users,name',
            'cours_id' => 'required',
        ];

        $messages = [
            'std_name.required' => __('site.its_require'),
            'std_name.exists' => __('site.its_exists_in_user'),
            // 'email.email' => 'The :attribute format is not valid.',
        ];

        $validatedData =   $this->validate($rules, $messages);



        $succes_std_regi =  StudentsRegistration::create([
            'user_id' => User::GetIdByName($this->std_name),
            'cours_id' => $this->cours_id
        ]);
        // toastr()->success('egege');
        // $validatedData = $this->validate();

        // StudentsRegistration::Create();
        if ($succes_std_regi) {
            $this->current_step = 2;
            $this->dispatchBrowserEvent('alert',
            ['type' => 'success',  'message' => __('site.students created successfully!')]
            );
        }
    }



    public function reset_()
    {

        $this->std_selected = "";
        $this->all_std_as_std_name = [];
    }

    public function updateQuery($std_name)
    {
        $td = $this->all_std_as_std_name = User::where('name', 'like', '%' . $std_name . '%')
            // ->select()
            ->get(['id', 'name'])
            ->toArray();
        // dd($td);
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

    public function  get_cours_fee($cours_id)
    {
        // dd($cours_id);

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




    public function get_std($name)
    {
        dd($name);
    }
}
