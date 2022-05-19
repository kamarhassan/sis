<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Cours;
use App\Models\CoursFee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StudentsRegistration;
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


        $std =  User::wherehas('students_only')->paginate(pagination_count()) ;
// return $std;
       return view('admin.students.index',compact('std'));
    }




    public function get_std_to_payment()
    {


        // $std_registartion =  StudentsRegistration::with('student:id,name','cours:id')->orderBy('created_at','Desc')->paginate(10);
         // $std->cours;
            // dd(  $std_registartion);

        //  $std_registartion =  User::wherehas('students_only')->wherehas('payment')->with(['cours','payment'])->paginate(10);
        //  $std_registartion =  User::find(8);//->with('payment')->get();
         $std_registartion =  User::select('id','name')->with('cours_students_to_payment')->wherehas('students_only')->paginate(10);//->with('payment')->get();

        //  $std_registartion->cours_students_to_payment;
        //  $std_registartion->test;
        //  $std_registartion->payment;

        return $std_registartion;
    }
}
