<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Cours;
use App\Models\CoursFee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\level;
use App\Models\Payment;
use App\Models\StudentsRegistration;
use App\Repository\Students\StudentsInterface;
use Illuminate\Support\Facades\DB;
use Yoeunes\Toastr\Facades\Toastr;

class StudentsController extends Controller
{


    protected $students;

    /**
     * CoursController constructor.
     * @param $cours
     */
    public function __construct(

        StudentsInterface $students

    ) {
        $this->students = $students;
    }




    public function students()
    {


        $std =  User::wherehas('students_only')->paginate(pagination_count());
        // return $std;
        return view('admin.students.index', compact('std'));
    }



    /**
     * get all students and sort by the registartion date
     * and groub by the user
     */
    public function get_std_to_payment()
    {

        try {

            $std_registartion =  StudentsRegistration::orderBy('created_at', 'DESC')

                ->selectRaw('count(*) as total, user_id,created_at')->groupby('user_id')
                ->with('student:id,name,email,photo')
                // ->paginate(10);
                ->paginate(100);
            // ->get();

            // return $std_registartion;
        } catch (\Throwable $th) {
            throw $th;
            // return $th;
        }


        return view('admin.payment.index', compact('std_registartion'));
    }




    /***
     * get all cours or one students fater click on paymeent button
     * and showing into modal
     */
    public function get_cours_std($id)
    {


        try {
            $std = StudentsRegistration::where('user_id', $id)->with('cours')->get();


            return response()->json($std);
        } catch (\Throwable $th) {
            //throw $th;
        }

        // return response()->json(Config::get('modetheme.mode'));
    }

    /****
     *
     * after choose one cours to be paid
     * it get all inforation needed
     *  $user ,  $cours ,   $fee_required ,   $fees  ,  $old_payment
     *
     */
    public function  user_paid_for_cours($cours_id, $user_id)
    {

        try {
            //code...

            $std = StudentsRegistration::where([
                'user_id' => $user_id,
                'cours_id' => $cours_id
            ])->get();
            // return $std;
            if ($std->count() > 0) {
                $user =  User::where('id', $user_id)->select('name')->get();

                $cours = Cours::where('id', $cours_id)
                    ->with('grade:id,grade', 'level:id,level', 'teacher:id,name')
                    ->get();

                $fee_required =  string_to_array($std[0]['feesRequired']);

                $fees  = CoursFee::wherein('id', $fee_required)
                    ->with('fee_type', 'currency', 'payment:id,amount,paid_amount,remaining,cours_fee_id')
                    ->get();

                // $old_payment = Payment::where('studentsRegistration_id', $std[0]['id'])->get();

                return  view('admin.payment.payment', compact('std', 'user', 'cours', 'fees'));
            } else {

                toastr()->error(__('site.this registration not found'));
                return redirect()->route('admin.students.get_std_to_payment');
            }
        } catch (\Throwable $th) {
            throw $th;
            // toastr()->error(__('site.you have error'));
            // return redirect()->route('admin.students.get_std_to_payment');
        }


        // return $id." - ". $t;
    }



    public function savepayment(Request $request)
    {
        // dd($request);
        return response()->json($request);
    }
}
