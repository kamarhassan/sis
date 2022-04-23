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
        'level_id', 'grade_id',
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
    public function scopeSelection_with_grade_level($query)
    {
        $array_of_data = [
            'courss.id',
            'courss.status',
            'admins.name',
            'courss.startDate',
            'courss.endDate',
            'courss.act_StartDa',
            'courss.act_EndDa',
            'courss.startTime',
            'courss.endTime',
            'levels.level',
            'grades.grade'
        ];
        return  Cours::join('grades', 'grade_id', '=', 'grades.id')
            ->join('levels', 'level_id', '=', 'levels.id')
            ->JOIN('admins', 'teacher_id', '=', 'admins.id')
            ->where('year', current_school_year())
            ->orderBy('courss.id', 'asc')
            ->get($array_of_data);
    }


    public function save_day_of_week($array)
    {
        $string = implode(";", $array);
        return $string;
    }

    public function select_day_of_week()
    {
        return Cours::select('days')->get();
        return explode(";", $array);
    }





    //    public function grade(){
    //        return $this->hasMany('App\Models\Grade','grade_id','id');
    //    }


    public function grade()
    {

        return $this->belongsTo('App\Models\Grade', 'grade_id', 'id');
    }
    public function level()
    {

        return $this->belongsTo('App\Models\Level', 'level_id', 'id');
    }


    public function students()
    {
        return $this->belongsToMany(User::class, 'studentsregistrations', 'cours_id', 'user_id', 'id', 'id');
    }


    public function  fee()
    {
        return $this->hasMany(CoursFee::class,'cours_id','id');
    }
}
