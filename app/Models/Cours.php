<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;


    protected $table ='courss';

    protected  $guarded = [];
    protected $hidden = [
        'created_at','updated_at'
    ];

    public function scopeSelection($query){
        return $query->where('year', current_school_year())->get(); //  select('name')->where('year');
    }
    // $array = array('This','is','a','string');
	// $string = implode(" ",$array);
	// echo $string;
    public function save_day_of_week($array){
        $string = implode(";",$array);
        return $string; //  select('name')->where('year');
    }

}
