<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fee_type extends Model
{
    use HasFactory;

    protected $table ='fee_types';
    protected  $guarded = [];
    protected $hidden = [
        'created_at','updated_at'
    ];
}
