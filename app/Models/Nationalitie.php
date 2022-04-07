<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nationalitie extends Model
{
    use HasFactory;
    protected $table ='nationalities';

    protected  $guarded = [];
    protected $hidden = [
        'created_at','updated_at'
    ];

    public function scopeSelection($query){
        return $query->select('name','code');
    }
}
