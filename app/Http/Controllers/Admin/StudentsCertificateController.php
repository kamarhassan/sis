<?php

namespace App\Http\Controllers\Admin;

use App\Models\CerteficateTemplate;
use App\Http\Controllers\Controller;
use App\Models\StudentsRegistration;
use Illuminate\Support\Facades\Crypt;
use App\Repository\Students\StudentsInterface;
use App\Repository\Certeficate\CertificateInterface;
use App\Http\Requests\Certificate\GenerateCertificateRequest;

class StudentsCertificateController extends Controller
{


   protected $studentsrepository;
   /**
    * @var CertificateInterface
    */
   protected $certificaterepository;
    

   // StudentsInterface
   public function __construct(StudentsInterface $studentsinterface,CertificateInterface $certificateinterface)
   {
      $this->studentsrepository = $studentsinterface;
      $this->certificaterepository =  $certificateinterface;
   }

   public function index($cours_id)
   {

      $cours_id = Crypt::decryptString($cours_id);
      // $student

      //  return $this->studentsrepository->students_for_cours_defined($cours_id);


      $students = StudentsRegistration::where('cours_id', '=', $cours_id)
         ->select('id', 'cours_id', 'user_id', 'cours_fee_total', 'remaining')
         ->orderBy('created_at', 'DESC')
         ->with('student:id,name')
         ->get();

      $certificates = CerteficateTemplate::where('isactive', 1)->get();
      return view('admin.certificate.index', compact('students', 'certificates'));
   }

   // $certificate_barcode = $this->certificaterepository->get_or_create_barcode_certificate_by_stdid_registration($studentsRegistration_id)


   public function post_generate_certificate(GenerateCertificateRequest $request)
   {


      $is_generated =  $this->certificaterepository-> certificate_templates($request->registration_id, $request->template_id,$request->user_id);

      
      if ($is_generated) {
         $message = __('site.Post created successfully!');
         $status = 'success';
         $route = "#";
      } else {
         $message = __('site.Post created unsuccessfully!');
         $status = 'error';
         $route = "#";
      }

      return response()->json(['message' => $message, 'status' => $status, 'route' => $route]);
   }
}
