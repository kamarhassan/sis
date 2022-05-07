<?php

namespace App\Http\Controllers\Admin\Livewire\Students;

use App\Models\User;
use App\Models\Cours;
use App\Models\Sponsor;
use Livewire\Component;
use App\Models\CoursFee;
use Illuminate\Support\Facades\DB;
use App\Models\StudentsRegistration;

use function PHPUnit\Framework\isEmpty;
use App\Repository\Cours\CoursInterface;

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
    public $fee_note;
    public $coursinfo;
    public $sponsor;
    public $sponsor_id;
    public $feerequired = [];
    public $coveredfee = [];
    public $validatedData_std = [];


    public function mount()
    {
        $this->init_model();
    }

    public function save_std_register()
    {

        $rules = [
            'std_name' => 'required|exists:Users,name',
            'cours_id' => 'required|exists:courss,id',
        ];

        $messages = [
            '*.required' => __('site.its_require'),
            'std_name.exists' => __('site.its_exists_in_user'),
            'cours_id.exists' => __('site.its_exists_in_cours_list'),
            // 'email.email' => 'The :attribute format is not valid.',
        ];

        $this->validatedData_std =  $this->validate($rules, $messages);




        // $coursinfo = Cours::with(['grade', 'level'])->find($this->cours_id);
        $this->coursinfo =        Cours::with(['grade', 'level', 'teacher'])->find($this->cours_id);
        $this->sponsor = $this->get_sponsor();

        $this->current_step = 2;
    }



    public function reset_()
    {

        $this->std_selected = "";
        $this->all_std_as_std_name = [];
    }

    public function updateQuery($std_name)
    {
        $this->all_std_as_std_name = User::where('name', 'like', '%' . $std_name . '%')
            ->get(['id', 'name'])
            ->toArray();
    }


    public function render()
    {
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

        $this->cours_fee_count = 0;
        if (CoursFee::Where(['cours_id' => $cours_id])->count() > 0) {
            $this->select_cours = $cours_id;
            $this->cours_fee = CoursFee::with(['currency', 'fee_type'])->Where(['cours_id' => $cours_id])->get();
            $this->cours_fee_sum = $this->cours_fee->sum('value');

            if (!$this->cours_fee->isEmpty())
                $this->cours_fee_count = $this->cours_fee->count();
            else $this->cours_fee_count = 0;
        }
    }




    public function get_sponsor()
    {
        return Sponsor::select()->get();
    }


    public function save_and_print_report()
    {
        try {
            DB::beginTransaction();
            $rgistre_id =   $this->save_std_regitration();
            // save payment
            DB::commit();
            if ($rgistre_id > 0) {
                $this->dispatchBrowserEvent(
                    'alert',
                    ['type' => 'success',  'message' => __('site.students created successfully!')]
                );
            }
        } catch (\Throwable $th) {
            DB::rollback();
            //throw $th;
        }

        $this->current_step = 3;
    }



    public function save_std_regitration()
    {
        try {
            $succes_std_regi =  StudentsRegistration::create([
                'user_id' => User::GetIdByName($this->std_name),
                'cours_id' => $this->cours_id,
                'notes' => $this->fee_note,
                'feesRequired' => array_to_string($this->feerequired),
            ]);

            if ($succes_std_regi) {
                return  $succes_std_regi->id;
            } else return -1;
        } catch (\Throwable $th) {
        }
    }
















    public function init_model()
    {
        $this->coursinfo = "";
        $this->select_cours = null;
        $this->cours_fee_count = -1;
        $this->std_name = "";
        $this->std_selected = "";
        $this->all_std_as_std_name = [];
        $this->fee_note = "";
        $this->sponsor_id = 0;
        $this->selectedfee = [];
        $this->coveredfee = [];
    }
}
