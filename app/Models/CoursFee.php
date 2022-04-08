<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoursFee extends Model
{
    use HasFactory;


    protected $table ='cours_fees';

    protected  $guarded = [];
    protected $hidden = [
        'created_at','updated_at'
    ];
}
