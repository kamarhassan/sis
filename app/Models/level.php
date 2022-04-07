<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class level extends Model
{

    use HasFactory;
    protected $table ='levels';

    protected  $guarded = [];
    protected $hidden = [
        'created_at','updated_at'
    ];

    public function scopeSelection($query){
        return $query->select('name');
    }

}

