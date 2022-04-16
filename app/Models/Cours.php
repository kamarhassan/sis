<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;


    protected $table = 'courss';

    protected  $guarded = [];
    protected $hidden = [
        'level_id','grade_id',
        'created_at', 'updated_at'
    ];

    public function scopeGetIdByName($query, $name)
    {
        return $query->where('grade', $name)->first()->id;
    }

    public function scopeSelection_with_grad_and_level_teacher()
    {
      return  Cours::join('grades', 'grade_id', '=', 'grades.id')
        ->join('levels', 'level_id', '=', 'levels.id')
        ->JOIN('admins', 'teacher_id', '=', 'admins.id')
        ->where('year', current_school_year())
        ->orderBy('courss.id', 'asc')
        ->get();
    }
    public function scopeSelection_wht($query)
    {
        return $query->join('grades', 'grade_id', '=', 'grades.id')
        ->join('levels', 'level_id', '=', 'levels.id')
        ->JOIN('admins', 'teacher_id', '=', 'admins.id')
        ->where('year', current_school_year())->get();
        // get(['admins.name as teacher' , 'courss.*','grades.*','levels.*']);
    }

    public function save_day_of_week($array)
    {
        $string = implode(";", $array);
        return $string; //  select('name')->where('year');
    }




//    public function grade(){
//        return $this->hasMany('App\Models\Grade','grade_id','id');
//    }


    public function grade()
    {

        return $this->belongsTo('App\Models\Grade', 'grade_id', 'id');
    }
}
