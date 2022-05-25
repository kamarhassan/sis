<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Cours;
use App\Models\CoursFee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StudentsRegistration;
use App\Repository\Students\StudentsInterface;
use Illuminate\Support\Facades\DB;


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




    public function get_std_to_payment()
    {

        try {

            $std_registartion =  StudentsRegistration::groupby('user_id')
                ->selectRaw('count(*) as total, user_id,created_at')->orderByDesc('created_at')
                ->with('student:id,name,email,photo')
                ->paginate(1000);
            // ->paginate(1000);
            // ->get();

            // return $std_registartion ;
        } catch (\Throwable $th) {
            throw $th;
            // return $th;
        }


        return view('admin.payment.index', compact('std_registartion'));
    }





    public function get_cours_std($id)
    {


        try {
            $std = StudentsRegistration::where('user_id', $id)->get();


            return response()->json($std);
        } catch (\Throwable $th) {
            //throw $th;
        }

        // return response()->json(Config::get('modetheme.mode'));
    }
}
