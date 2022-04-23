<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\Students\StudentsInterface;
use Illuminate\Http\Request;
use App\Models\Cours;
use App\Models\CoursFee;

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



    
    public function test()
    {


        return CoursFee::Where(['cours_id'=>22])->get();
        
        return Cours::with(['fee'])->select($fee)->find(22);
    }
}