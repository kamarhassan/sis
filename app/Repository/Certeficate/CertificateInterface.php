<?php

namespace App\Repository\Certeficate;

interface CertificateInterface
{
   public function get_all_certificate();
   // public function   get_all_certificate_templates();
   public function    certificate_templates($studentsRegistration_id, $cert_id, $user_id);
   public function    get_or_create_barcode_certificate_by_stdid_registration($studentsRegistration_id,$cert_id);
   public function    get_certificate_by_barcode($barcode);
   public function    full_marks($studentsRegistration_id, $cert_id, $user_id);
   
   // public function    prepare_header_certificate($header_marks);



}
