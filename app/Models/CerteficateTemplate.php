<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CerteficateTemplate extends Model
{
   use HasFactory;
   protected  $guarded = [];
   protected  $table = 'certeficate_templates';

protected $casts = [
   'template' => 'array',
];
}
