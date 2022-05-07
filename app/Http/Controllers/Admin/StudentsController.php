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

       return view('admin.students.index',compact('std'));
    }




    public function test()
    {


        return CoursFee::Where(['cours_id'=>22])->get();

        return Cours::with(['fee'])->select($fee)->find(22);
    }
}
