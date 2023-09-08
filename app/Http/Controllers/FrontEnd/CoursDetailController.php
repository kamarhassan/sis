<?php

namespace App\Http\Controllers\FrontEnd;


use App\Http\Controllers\Controller;
use App\Models\NotificationAdmin;
use App\Repository\Cours\CoursInterface;
use App\Repository\Cours_fee\CoursFeeInterface;
use Illuminate\Support\Facades\Auth;

class CoursDetailController extends Controller
{
   protected $cours;
   protected $coursfee;

   public function __construct(CoursInterface $cours, CoursFeeInterface $coursfeeinterface)
   {
      $this->cours = $cours;
      $this->coursfee = $coursfeeinterface;

   }


   public function cours_details($category = null, $cours = null, $cours_id)
   {
      try {
//           return $cours_id;
//           $user_id= Auth::user()->id; //code...
//          
         
         $cours = $this->cours->is_defined($cours_id);
         if (!$cours) {
            toastr()->warning(__('site.this cours is not defined'));
            return redirect()->route('web.index');
         } else {

               $cours->category_grade_level;
//            $grade = $cours->grade;
            $teacher_name = $cours->teacher_name;
             $fee = $this->coursfee->cours_fee_with_type_and_currency($cours); //->cours_fee_with_type($cours_id);
//            return  $cours;
            return view('frontend.cours.cours-detail',
               compact('cours',  'teacher_name', 'fee'));
         }
      } catch (\Throwable $th) {
//         throw $th;
         toastr()->warning(__('site.you site.you have error'));
         return redirect()->route('web.index');
      }
   }
}
