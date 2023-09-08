<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CerteficateTemplate;
use App\Models\StudentsRegistration;
use Illuminate\Support\Facades\Auth;
use App\Repository\Cours\CoursInterface;
use App\Repository\Marks\MarksInterface;
use App\Repository\RegisterCours\RegisterCoursInterface;


class UserDashboradController extends Controller
{
   protected $cours;
   protected $registercoursrepository;
  
   public function __construct(CoursInterface $cours, RegisterCoursInterface $registercoursinterface )
   {
      $this->cours = $cours;
      $this->registercoursrepository = $registercoursinterface;
    
      //   $this->middleware('auth');
   }

   /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
   public function index()
   {
      return view('frontend.dashborad.dashborad');
   }

   public function user_cours_reserved()
   {

         $user_cours = $this->registercoursrepository->user_cours_reserved(Auth::user()->id);
     
      return  view('frontend.cours.new-user-cours', compact('user_cours' ));
   }


   // public function certificate($studentsRegistration_id)
   // {
   //    $user_id = Auth::user()->id;
      
   //    $studentsregistration = StudentsRegistration::find($studentsRegistration_id);
   //    return $this->Marksrepository->StudentMarks($studentsregistration['cours_id'], $user_id);

   //    return  view('frontend.user.certificate', compact('data'));
   // }




   public function cours()
   {

       $user_id = Auth::user()->id;
      $student_courss = StudentsRegistration::select('id', 'user_id', 'cours_id', 'remaining', 'cours_fee_total')
         ->where('user_id', $user_id)->with('cours:id,categorie_id,currencies_id,teacher_id:grade:level:teacher_name:cours_currency')->get();

      $student_courss->each(function ($cours) {
//         dd($cours->category_grade_level);
         $cours->category = $cours['cours']['category_grade_level']['name'];
         $cours->category_id = $cours['cours']['category_grade_level']['id'];
         $cours->grade = $cours['cours']['category_grade_level']['grade']['grade'];
         $cours->level = $cours['cours']['category_grade_level']['level']['level'];
         $cours->currency_abbr = $cours['cours']['cours_currency']['abbr'];
         $cours->teacher_name = $cours['cours']['teacher_name']['name'];
         unset($cours['cours']);
         return  $cours;   
      });
//      return $student_courss;
       $certificate = CerteficateTemplate::where('isactive', 1)->get();
      return  view('frontend.dashborad.cours', compact('student_courss','certificate'));
   }
}
