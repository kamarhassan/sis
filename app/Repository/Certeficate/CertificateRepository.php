<?php

namespace App\Repository\Certeficate;

use App\Models\Level;
use App\Models\Certificate;

class CertificateRepository implements CertificateInterface
{
  
    public function get_all_certificate()
    {
        $certificates = Certificate::with('grade')->get();
        $certificates->each(function ($certificate) {
            $level = Level::whereIn('id', $certificate->levels)->get(['id', 'level']);
            $certificate->levels = $level;
            return $certificate;
        });
        return $certificates;
    }
}
