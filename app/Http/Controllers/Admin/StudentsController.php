<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Cours;
use App\Models\level;
use App\Models\Payment;
use App\Models\Receipt;
use App\Models\CoursFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yoeunes\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use App\Models\StudentsRegistration;
use App\Http\Requests\PaymentRequest;
use App\Repository\Students\StudentsInterface;

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

            // $std_registartion =  StudentsRegistration::whereBetween('created_at', [
            //     $start_date, $end_date
            //   ])-> orderBy('created_at', 'DESC')
            $std_registartion =  StudentsRegistration::where('created_at', 'LIKE', '%' . current_school_year() . '%')
                ->orderBy('created_at', 'DESC')
                ->selectRaw('count(*) as total, user_id,created_at')->groupby('user_id')
                ->with('student:id,name,email,photo')
                // ->paginate(10);
                // ->paginate(100);
                ->get();

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


          $redirect_route = route('admin.payment.user_paid_for_cours',[ $std[0]['cours_id'], $std[0]['user_id']]);
           return response()->json([$std, $redirect_route]);
        } catch (\Throwable $th) {
         throw $th;
        }

        // return response()->json(Config::get('modetheme.mode'));
    }
}
