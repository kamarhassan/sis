<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marks extends Model
{
    use HasFactory;
   //  std_marks
   protected $table = 'marks';

    protected  $guarded = [];
  


    protected $casts = [
        'std_marks' => 'array',
    ];

    protected function stdMarks(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value),
            set: fn ($value) => json_encode($value),
        );
    }
}
