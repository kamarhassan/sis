<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentsCertificateBarcode extends Model
{
    use HasFactory;
    protected $table = 'students_certificate_barcodes';
    protected  $guarded = [];
}
