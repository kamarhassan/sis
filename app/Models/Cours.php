<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table ='courss';

    protected  $guarded = [];
    protected $hidden = [
        'created_at','updated_at'
    ];

    public function scopeSelection($query){
        return $query->where('year', current_school_year())->get(); //  select('name')->where('year');
    }
}
