<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentsRegistration extends Model
{
    use HasFactory;
    protected $table = 'studentsregistrations';

    protected  $guarded = [];
    protected $hidden = [
        'created_at', 'updated_at'
    ];


  
}
