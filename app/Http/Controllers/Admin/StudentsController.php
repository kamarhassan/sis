<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\Students\StudentsInterface;
use Illuminate\Http\Request;

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
        return $this->students->get_std_cours(22, ['users.id', 'users.name', 'users.created_at']);
    }

    public function Registration()
    {
        // return view('admin.students.std_registration.registeration');
    }
}
