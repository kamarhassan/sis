<?php

namespace App\Http\Controllers\Admin\Livewire\Students;

use App\Models\User;

// use App\Models\level;
use App\Models\Cours;
use App\Models\Payment;
use App\Models\Sponsor;
use Livewire\Component;
use App\Models\CoursFee;
use App\Models\Payment_receipt;
use App\Models\Receipt;
use Illuminate\Support\Facades\DB;
use App\Models\StudentsRegistration;
use App\Traits\Nb_to_Word;

class Registration extends Component
{
    use Nb_to_Word;

    public $current_step = 1;
    public $cours_id;
    public $cours_ = "";
    public $cours_fee = [];
    public $select_cours;
    public $std_name;
    public $std_selected;
    public $cours_fee_count;
    public $cours_fee_sum;
    public $cours_fee_required_sum;
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
    public $select_fee_required;
    public $init_amount_to_paid;
    public $receipt_information;
    public $receipt_information_id;
    public $payment_information;



    public function mount()
    {
        $this->init_model();
    }

    public function validate_std_register()
    {

        $rules = [
            'std_name' => 'required|exists:users,name',
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
        $this->all_std_as_std_name = [];
    }



    public function reset_()
    {

        $this->std_selected = "";
        $this->all_std_as_std_name = [];
    }

    public function updateQuery()
    {
        $this->all_std_as_std_name = User::where('name', 'like', '%' . $this->std_name . '%')
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





    /***
     * this method gets the fee required after the registration of students
     * the fee is selected from admin to this  student only
     * it might differ between the students
     */
    public function get_fee_required_cours($id_fee_required)
    {
        $this->cours_fee_required_sum = 0;
        $fee_requied = string_to_array($id_fee_required);

        $select_fee_required_cours = [];
        $t = [];
        try {
            // dd($this->registration_students);
            $select_fee_required_cours = [];
            for ($i = 0; $i < count($fee_requied); $i++) {

                $temp = CoursFee::where(['id' => $fee_requied[$i]])->with('fee_type')->get();

                $select_fee_required_cours[] = [
                    'id' => $temp[0]->id,
                    'fee_value' => $temp[0]->value,
                    'fee_type_id' => $temp[0]->fee_type['id'],
                    'fee_type_value' => $temp[0]->fee_type['fee'],
                    'regitration_date' => $this->registration_students->created_at
                ];
                $this->cours_fee_required_sum += $temp[0]->value;
            }
            // dd($select_fee_required_cours);
            return  $select_fee_required_cours;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * save only the registration of students into tale registrationstudents
     *
     */
    public function save_std_regitration($cours_fee_total, $remaining)
    {
        //    dd($this->feerequired);
        try {
            $user_id = User::GetIdByName($this->std_name);
            $succes_std_regi = null;
            asort($this->feerequired);
            $succes_std_regi = StudentsRegistration::updateOrCreate([
                'user_id' => $user_id,
                'cours_id' => $this->cours_id,
            ], [
                'user_id' => $user_id,
                'cours_id' => $this->cours_id,
                'notes' => $this->fee_note,
                'feesRequired' => array_to_string($this->feerequired),
                'cours_fee_total' => $cours_fee_total,
                'remaining' => $remaining,
            ]);

            if ($succes_std_regi) {
                return  $succes_std_regi;
            } else return -1;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // save regstartion students and get the fee required of this regustration
    public function save_and_go_to_payment()
    {
        DB::beginTransaction();
        try {
            // dd($this->registration_students);
            $fee_cours_and_reaminning = $this->max_amount_to_paid();
            $this->registration_students = $this->save_std_regitration(0, 0); // no fee
            // save payment
            //  dd( $this->registration_students->id);
            if ($this->registration_students->id > 0) {
                $this->dispatchBrowserEvent(
                    'alert',
                    ['type' => 'success',  'message' => __('site.students created successfully!')]
                );
                // dd(170);

                $this->select_fee_required =  $this->get_fee_required_cours($this->registration_students->feesRequired);

                $fee_cours_and_reaminning = $this->max_amount_to_paid();

                // dd(  $fee_cours_and_reaminning);
                $this->save_std_regitration($fee_cours_and_reaminning, $fee_cours_and_reaminning);
                //return redirect()->route('admin.students.Registration-2/{id}', $this->registration_students->id);

                DB::commit();
                return redirect()->route(
                    'admin.payment.user_paid_for_cours',
                    [$this->registration_students->cours_id, $this->registration_students->user_id]
                );
                // return redirect()->route('admin.payment.user_paid_for_cours', $this->registration_students->user_id, $this->registration_students->cours_id);

                // return redirect()->route('admin.payment.user_paid_for_cours', $this->registration_students->user_id, $this->registration_students->cours_id);
            }
        } catch (\Throwable $th) {
            throw $th;
            DB::rollback();
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
    public function max_amount_to_paid()
    {
        return array_sum(array_column($this->select_fee_required, 'fee_value'));
    }

    public function save_receipt($receipt_id)
    {
        $receipt_information = null;
        if ($receipt_id == null) {
            $receipt_information =  Receipt::Create([
                'currencies_id' => $this->cours_fee[0]->currency['id'],
                'amount' => $this->amount_to_paid,
                'description' => $this->receipt_description,
                'payType' => $this->payment_type,
                'user_id' => $this->registration_students->user_id,
                'amount_total' => $this->amount_to_paid,
                'studentsRegistration_id' => $this->registration_students->id,
            ]);

            $this->receipt_information_id = $receipt_information->id;
        } else {
            $receipt_information =  Receipt::find($receipt_id);
            $receipt_information->update([
                'currencies_id' => $this->cours_fee[0]->currency['id'],
                'amount' => $this->amount_to_paid,
                'description' => $this->receipt_description,
                'payType' => $this->payment_type,
                'user_id' => $this->registration_students->user_id,
                'amount_total' => $this->amount_to_paid,
                'studentsRegistration_id' => $this->registration_students->id,
            ]);
            $this->receipt_information_id = $receipt_id;
        }


        return $receipt_information;
    }



    public function save_payment()
    {
        $max_amount_to_paid = $this->max_amount_to_paid();
        $rules = [
            'amount_to_paid' => 'required|numeric|min:1|max:' . $max_amount_to_paid,
        ];

        $messages = [
            '*.required' => __('site.its_require'),
            'amount_to_paid.numeric' => __('site.must be a number'),
            'amount_to_paid.max' => __('site.amount to paid must be under fees'),
            'cours_id.min' => __('site.must be a number positive'),

        ];
        $this->validatedData_payment =  $this->validate($rules, $messages);
        $this->init_amount_to_paid = $this->amount_to_paid;
        $payment = null;
        try {
            $this->registration_students = $this->save_std_regitration($max_amount_to_paid, $max_amount_to_paid - $this->amount_to_paid);

            $this->receipt_information = $this->save_receipt($this->receipt_information_id);

            foreach ($this->select_fee_required as $key => $fee) {

                if ($this->amount_to_paid <= $fee['fee_value']) {
                    $payment[] =   Payment::updateOrCreate(
                        [
                            'studentsRegistration_id' => $this->registration_students->id,
                            'cours_fee_id' => $fee['id']
                        ],
                        [
                            'studentsRegistration_id' => $this->registration_students->id,
                            'amount' => $fee['fee_value'], // initial amount
                            'paid_amount' => $this->amount_to_paid, //amount paided from students
                            'cours_fee_id' => $fee['id'], //
                            'remaining' => $fee['fee_value'] - $this->amount_to_paid, //
                            'receipt_id' => $this->receipt_information->id, //
                        ]
                    );
                    /****
                     * change to $this->select_fee_required
                     * to set  type and fe and remainnig into one array
                     */
                    $this->payment_information[] = [
                        'fee_type' => $this->select_fee_required[$key]['fee_type_value'],
                        'studentsRegistration_id' => $this->registration_students->id,
                        'amount' => $fee['fee_value'], // initial amount
                        'paid_amount' => $this->amount_to_paid, //amount paided from students
                        'cours_fee_id' => $fee['id'], //
                        'remaining' => $fee['fee_value'] - $this->amount_to_paid, //
                        'receipt_id' => $this->receipt_information->id,
                    ];

                    $this->amount_to_paid = 0;
                    // break;
                } else {
                    if ($this->amount_to_paid == 0) {

                        $payment[] =   Payment::updateOrCreate(
                            [
                                'studentsRegistration_id' => $this->registration_students->id,
                                'cours_fee_id' => $fee['id']
                            ],
                            [
                                'studentsRegistration_id' => $this->registration_students->id,
                                'amount' => $fee['fee_value'], // initial amount
                                'paid_amount' => 0, //amount paided from students
                                'cours_fee_id' => $fee['id'], //
                                'remaining' => $fee['fee_value'], //
                                'receipt_id' => $this->receipt_information->id, //
                            ]
                        );
                    } else {
                        $payment[] =   Payment::updateOrCreate(
                            [
                                'studentsRegistration_id' => $this->registration_students->id,
                                'cours_fee_id' => $fee['id']
                            ],
                            [
                                'studentsRegistration_id' => $this->registration_students->id,
                                'amount' => $fee['fee_value'], // initial amount
                                'paid_amount' => $fee['fee_value'], //amount paided from students
                                'cours_fee_id' => $fee['id'], //
                                'remaining' => $fee['fee_value'] - $fee['fee_value'], //
                                'receipt_id' => $this->receipt_information->id, //
                            ]
                        );
                        /****
                         * change to $this->select_fee_required
                         * to set  type and fe and remainnig into one array
                         */
                        $this->payment_information[] = [
                            'fee_type' => $this->select_fee_required[$key]['fee_type_value'],
                            'studentsRegistration_id' => $this->registration_students->id,
                            'amount' => $fee['fee_value'], // initial amount
                            'paid_amount' => $fee['fee_value'], //amount paided from students
                            'cours_fee_id' => $fee['id'], //
                            'remaining' => $fee['fee_value'] - $fee['fee_value'], //
                            'receipt_id' => $this->receipt_information->id,
                        ];
                        $this->amount_to_paid = $this->amount_to_paid - $fee['fee_value'];
                    }
                }
            }
            // dd($this->receipt_information);
        } catch (\Throwable $th) {
            throw $th;
        }

        // $this->payment_information =  $payment;
        // dd($this->payment_information);
        // dd(array_diff($this->select_fee_required,$payment));

        $this->current_step = 4;
    }


    public function back_()
    {
        if ($this->current_step != 1)
            $this->current_step--;
    }




    public function init_model()
    {$this->cours_fee = null;
        $this->registration_students = 0;
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
        $this->select_fee_required = [];
        $this->cours_fee_required_sum = 0;
        $this->init_amount_to_paid = 0;
        $this->receipt_information = null;
        $this->receipt_information_id = null;
        $this->payment_information  = null;

        // $this->receipt_description = "payment from " . $this->std_name + "for " . $this->$coursinfo->grade['grade'] + " - " + $this->$coursinfo->grade['level'];
    }


    public function back_and_reset_fee_()
    {
        $this->back_();
        $this->feerequired = [];
    }
}
