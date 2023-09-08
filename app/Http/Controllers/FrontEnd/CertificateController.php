<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Categorie;
use App\Models\Certificate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Milon\Barcode\DNS1D;
use Brick\Math\BigInteger;
use Yoeunes\Toastr\Toastr;
use Illuminate\Http\Request;
use App\Models\CerteficateTemplate;
use App\Http\Controllers\Controller;
use App\Models\StudentsRegistration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use App\Repository\Marks\MarksInterface;
use App\Repository\Certeficate\CertificateInterface;
use App\Http\Requests\FronEnd\Cetificate\SearcheByBarcode;

class CertificateController extends Controller
{



   protected $Marksrepository;
   protected $certificaterepository;

   public function __construct(MarksInterface $marksInterface, CertificateInterface $certificateInterface)
   {
      $this->Marksrepository = $marksInterface;
      $this->certificaterepository = $certificateInterface;
   }

   public function certificate($studentsRegistration_id, $cert_id)
   {

      $final_template = $this->certificaterepository->certificate_templates($studentsRegistration_id, $cert_id, Auth::user()->id);

      if ($final_template == 'marks not defined') {

         Toastr()->error(__('site.marks not found'));
         return redirect()->back();
      }

      $template = $final_template['final_template'];
      $mark = $final_template['mark'];

      $certificate_barcode = $this->certificaterepository->get_or_create_barcode_certificate_by_stdid_registration($studentsRegistration_id, $cert_id);
      // $certificate_barcode= $certificate_barcode['certificate_barcode'];
      return  view('frontend.student-certificate.certificate', compact('template', 'mark', 'certificate_barcode'));
   }


   public function get_student_cetificate_by_barcode()
   {
      $certificates = CerteficateTemplate::where('isactive', 1)->where('availabletosearche', 1)->get();
      return view('frontend.student-certificate.get-certificate-by-barcode', compact('certificates'));
   }


   public function searche_and_get_student_cetificate_by_barcode(SearcheByBarcode $request)
   {


      try {
         //code...
         $certificate_by_barcode =  $this->certificaterepository->get_certificate_by_barcode($request->barcode); //;view('frontend.student-certificate.get-certificate-by-barcode');
         if ($certificate_by_barcode == false) {
            $status = 'error';
            $message = __('site.barcode is not defined or the student has any issue');
            $route = '#';
            $template = __('site.not fround');
            $mark = "";
         } else {
            $status = 'success';
            $message = __('site.');
            $route = '#';
            $template = $certificate_by_barcode['final_template'];
            $mark = $certificate_by_barcode['mark'];
         }
         return response()->json([
            'status' => $status,
            'message' => $message,
            'route' => $route,
            'final_template' => $template,
            'mark' => $mark

         ]);
      } catch (\Throwable $th) {
         throw $th;
      }
   }
   public function get_student_cetificate_by_barcode_scan($barcode)
   {


      try {
         //code...
         $certificate_by_barcode =  $this->certificaterepository->get_certificate_by_barcode($barcode); //;view('frontend.student-certificate.get-certificate-by-barcode');
         if ($certificate_by_barcode == false) {
            $status = 'error';
            $message = __('site.barcode is not defined or the student has any issue');
            $route = '#';
            $template = __('site.not fround');
            $mark = "";
         } else {
            $status = 'success';
            $message = __('site.');
            $route = '#';
            $template = $certificate_by_barcode['final_template'];
            $mark = $certificate_by_barcode['mark'];
         }
         return view('frontend.student-certificate.scan-qrcode', compact(
            'status',
            'message',
            'route',
            'template',
            'mark'
         ));
         // return response()->json([
         //    'status' => $status,
         //    'message' => $message,
         //    'route' => $route,
         //    'final_template' => $template,
         //    'mark' => $mark

         // ]);
      } catch (\Throwable $th) {
         throw $th;
      }
   }
   
   
   
   public function  certificate_detail($certificate_name,$id){
      
      $id= Crypt::decryptString($id);
      $certificate =  Certificate::find($id);
       $categories =  Categorie::whereIn('id',$certificate['categorie_id'])->get();
     
      return view('frontend.cours-certificate.certificate-details',compact('certificate' ,'categories'));
   }
   
   
   
   
}
