<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CerteficateTemplate;
use App\Models\StudentsRegistration;
use Illuminate\Support\Facades\Crypt;
use App\Repository\Students\StudentsInterface;

class StudentsCertificateController extends Controller
{


   protected $studentsrepository;
   // StudentsInterface
   public function __construct(StudentsInterface $studentsinterface)
   {
      $this->studentsrepository = $studentsinterface;
   }
   public function index($cours_id)
   {
      
      $cours_id = Crypt::decryptString($cours_id);
      // $student

      //  return $this->studentsrepository->students_for_cours_defined($cours_id);


      $students =  StudentsRegistration::where('cours_id', '=', $cours_id)
      ->select('id', 'cours_id', 'user_id', 'cours_fee_total', 'remaining')
         ->orderBy('created_at', 'DESC')
         ->with('student:id,name')
         ->get();
    
$certificates = CerteficateTemplate::where('isactive',1)->get();
      return view('admin.certificate.index',compact('students','certificates'));
   }
   // $certificate_barcode = $this->certificaterepository->get_or_create_barcode_certificate_by_stdid_registration($studentsRegistration_id)


   public function post_generate_certificate(Request $request)
   {
     return $request;
   }
}
