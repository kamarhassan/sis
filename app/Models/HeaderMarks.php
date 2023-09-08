<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderMarks extends Model
{
    use HasFactory;
    protected  $guarded = [];  
    
    protected $casts = [
      'marks' => 'array',
  ];
}
