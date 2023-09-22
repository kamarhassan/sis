<?php

namespace App\Repository\Certeficate;

use App\Models\Categorie;
use App\Models\Grade;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Cours;
use App\Models\Level;
use App\Models\Marks;
use Milon\Barcode\DNS2D;

use App\Models\Certificate;
use App\Models\HeaderMarks;

use App\Models\CerteficateTemplate;

use App\Models\StudentsRegistration;

use Illuminate\Support\Facades\Blade;
use App\Models\StudentsCertificateBarcode;


class CertificateRepository implements CertificateInterface
{

   public function get_all_certificate()
   {
      $certificates = Certificate::get();

      $certificates->each(function ($certificate) {


         if ($certificate->categorie_id != null) {

            $categoies = Categorie::whereIn('id', $certificate->categorie_id)->get(['id', 'name']);
            $certificate->categorie = $categoies;
         }


         return $certificate;
      });
      return $certificates;
   }




   public function certificate_templates($studentsRegistration_id, $cert_id, $user_id)
   {

      try {

         $std_user = User::find($user_id);

         $studentsregistration = StudentsRegistration::find($studentsRegistration_id);
         $cours = Cours::find($studentsregistration['cours_id']);
         StudentsCertificateBarcode::where('studentsRegistration_id', $studentsregistration->id)->first() == null ? $has_barcode = 0 : $has_barcode = 1;

         if ($studentsregistration['remaining'] > 0 && $has_barcode == 0) {
            toastr()->warning(__('site.your certeficate has blocked because you have an amount'));
            return redirect()->back();
         }
         $cert = CerteficateTemplate::where('isactive', '=', '1')->find($cert_id);


         $user_id = $std_user['id'];
         $name = $std_user->name;
         $email = $std_user['email'];
         $birthdate = $std_user['birthday'];
         $place_of_birth = $std_user['birthday_place'];
         $cours->category_grade_level;
         $grade = $cours['category_grade_level']['grade']['grade'];
         $level = $cours['category_grade_level']['level']['level'];
         $duration = $cours['duration'];
         $year = $cours['year'];
         $class_start_date = $cours['act_StartDa'];
         $class_end_date = $cours['act_EndDa'];
         $print_date = Carbon::now()->format('d-m-y');


         $final_mark_table_th = $final_mark_table_td = '';
         $mark =  Marks::where(['cours_id' => $cours['id'], 'user_id' => $user_id])->get();
         if ($mark->count() > 0) {

            $mark = $mark[0]; // Marks::where(['cours_id' => $cours['id'], 'user_id' => $user_id])->get()[0];
            $head_marks = HeaderMarks::find($mark['header_mark_id']);

            foreach ($head_marks['marks'] as $key => $value) {
               $final_mark_table_th .= '<th>' . $value['marks_name'] . '/' . $value['marks'] . '</th>';
            }

            $final_mark_table_th .= '<th>' . __('site.total marks') . '/' . $head_marks['total'] . '</th>';
            $final_mark_table_th .= '<th>' . __('site.percent') . ' %</th>';

            foreach ($mark['std_marks'] as $key => $value) {
               $final_mark_table_td .= '<td>' . $value . '</td>';
            }

            $final_mark_table_td .= '<td>' . $mark['total'] . '</td>';
            $final_mark_table_td .= '<td>' . $mark['percent'] . '</td>';


            $mark = '<div class="table-responsive"><table id="datatable1" class="table table-striped table-bordered" cellspacing="0" width="100%">';
            $mark .=  '<thead><tr>' . $final_mark_table_th . '</tr></thead><tbody><tr>' . $final_mark_table_td . '</tr></tbody>';
            $mark .= '</table></div>';

            strpos($cert['template'], '{{$mark}}') !== false ? $cert_ =   str_replace('{{$mark}}', '<div class="mark_table"></div>', $cert['template']) : $cert_ = $cert['template'];


            $final_template = Blade::render($cert_, [
               'name' => $name, 'user_id' => $user_id, 'email' => $email, 'birthdate' => $birthdate,
               'place_of_birth' => $place_of_birth, 'grade' => $grade, 'level' => $level, 'duration' => $duration, 'year' => $year,
               'class_start_date' => $class_start_date, 'class_end_date' => $class_end_date, 'print_date' => $print_date,
               //  'mark' =>    '<table class="table table-striped table-bordered sourced-data"><thead><tr>' . $final_mark_table_th . '</tr></thead><tbody><tr>' . $final_mark_table_td . '</tr></tbody></table>'// $final_mark_table,
            ]);

            return ['final_template' => $final_template, 'mark' => $mark];
         }
         return "marks not defined";
      } catch (\Throwable $th) {
         // return "error please contact to provider";
         throw $th;
      }
   }



   public function    get_or_create_barcode_certificate_by_stdid_registration($studentsRegistration_id, $cert_id)
   {

      try {
         //code...
         $barcode =  StudentsCertificateBarcode::where(['studentsRegistration_id' => $studentsRegistration_id, 'certificate_id' => $cert_id])->get();
         $code_number = 0;

         if ($barcode->count() > 0) {
            $code_number = $barcode[0]['code_number'];
         } else {

            $barcode =   StudentsCertificateBarcode::create([
               'studentsRegistration_id' => $studentsRegistration_id,
               'code_number' => $this->generateUniqueCode(),
               'certificate_id' => $cert_id
            ]);
            $code_number = $barcode['code_number'];
         }

         $link = 'https://www.example.com';

         $barcode = new DNS2D();
         // $link =    explode(LaravelLocalization::getCurrentLocale(), url()->full())[0] . LaravelLocalization::getCurrentLocale() . "/ " . $code_number;
         $link =  route('web.searche.certificate.by.barcode.scan', $code_number);
         return [
            // 'certificate_barcode' => $barcode->getBarcodeHTML($code_number, 'EAN13'),
            'certificate_barcode' => $barcode->getBarcodeHTML($link, 'QRCODE'),
            'code' => $code_number
         ];
      } catch (\Throwable $th) {
         throw $th;
      }
   }




   public function generateUniqueCode()
   {
      do {

         $code = random_int(10000000000, 99999999999);
      } while (StudentsCertificateBarcode::where("code_number", "=", $code)->first());

      return $code;
   }

   public function   get_certificate_by_barcode($barcode)
   {
      $barcode =  StudentsCertificateBarcode::where("code_number",  $barcode)->first();
      //   dd($barcode);
      if ($barcode->count() == 0)
         return false;
      $std = StudentsRegistration::find($barcode['studentsRegistration_id']);

      // if ($std->count() == 0 || $std->remaining > 0)
      //    return false;

      return   $this->certificate_templates($std['id'],  $barcode['certificate_id'], $std['user_id']);
   }
}
