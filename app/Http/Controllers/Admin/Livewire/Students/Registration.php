<?php

namespace App\Http\Controllers\Admin\Livewire\Students;

use App\Models\User;
use App\Models\Cours;
use App\Models\Sponsor;
use Livewire\Component;
use App\Models\CoursFee;
use App\Models\Payment;
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
    public $validatedData_payment = [];
    public $amount_to_paid;
    public $receipt_description;
    public $ini_fee_required;
    public $payment_type;
    public $registration_students;


    public function mount()
    {
        $this->init_model();
    }

    public function validate_std_register()
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
        $this->coursinfo =  Cours::with(['grade', 'level', 'teacher'])->find($this->cours_id);
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
        $cours_ = Cours::where(['year' => current_school_year(), 'status' => 'open'])->with('grade', 'level', 'teacher')->get();
        // dd($cours_);
        return view('admin.livewire.students.registration', [
            'cours' => $cours_
        ]);
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


    public function save_and_go_to_payment()
    {
        try {
            DB::beginTransaction();
            $this->registration_students =    $this->save_std_regitration();
            // save payment

            DB::commit();
            if ($this->registration_students->id > 0) {
                $this->dispatchBrowserEvent(
                    'alert',
                    ['type' => 'success',  'message' => __('site.students created successfully!')]
                );


                //return redirect()->route('admin.students.Registration-2/{id}', $this->registration_students->id);
                $this->current_step = 3;
            }
        } catch (\Throwable $th) {
            DB::rollback();
            //throw $th;
        }
    }



    public function save_std_regitration()
    {

        // dd($this->feerequired);
        try {
            asort($this->feerequired);
            $succes_std_regi =  StudentsRegistration::create([
                'user_id' => User::GetIdByName($this->std_name),
                'cours_id' => $this->cours_id,
                'notes' => $this->fee_note,
                'feesRequired' => array_to_string($this->feerequired),
            ]);

            if ($succes_std_regi) {
                return  $succes_std_regi;
            } else return -1;
        } catch (\Throwable $th) {
        }
    }


    public function switch_payment_type($paym_methode)
    {

        switch ($paym_methode) {
            case 'pay_check_':
                $this->payment_type = 'pay_check_';
                break;

            case 'pay_cache_':
                $this->payment_type = 'pay_cache_';
                break;
            default:
                $this->payment_type = "no payment methode";
        }
    }

    public function save_payment()
    {

        $rules = [
            'amount_to_paid' => 'required|numeric|min:1',

        ];

        $messages = [
            '*.required' => __('site.its_require'),
            'amount_to_paid.numeric' => __('site.must be a number'),
            'cours_id.min' => __('site.must be a number positive'),
            // 'email.email' => 'The :attribute format is not valid.',
        ];

        $this->validatedData_payment =  $this->validate($rules, $messages);


        $fee_requied = string_to_array($this->registration_students->feesRequired);

        //  dd($this->cours_fee);
        $select_fee_required = [];
        foreach ($fee_requied as $key => $fee) {

            $select_fee_required[] = CoursFee::where('id', $fee)->get(['id', 'value']);
        }

        foreach ($select_fee_required as $key => $fee) {
            if ($this->amount_to_paid <= $fee[$key]->value) {

                Payment::create([
                    'studentsRegistration_id' => $this->registration_students->id,
                    'amount' => $fee[$key]->value, // initial amount
                    'paid_amount' => $this->amount_to_paid, //amount paided from students
                    'cours_fee_id' => $fee[$key]->id, //
                ]);
                break;
            }
        }


        // dd($select_fee_required);

        $this->current_step=4;




    }











    public function init_model()
    {
        $this->registration_students = null;
        $this->coursinfo = "";
        $this->select_cours = null;
        $this->cours_fee_count = -1;
        $this->std_name = "";
        $this->std_selected = "";
        $this->all_std_as_std_name = [];
        $this->fee_note = "";
        $this->sponsor_id = 0;
        $this->feerequired = [];
        $this->coveredfee = [];
        $this->amount_to_paid = 0;
        $this->ini_fee_required = 1;
        $this->payment_type = "pay_cache_";
        // $this->receipt_description = "payment from ".$this->std_name + "for ".$this->select_cours;
    }
}
