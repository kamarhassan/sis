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

    public function scopeSelection_with_grad_and_level()
    {
        return Cours::join('grades', 'grade_id', '=', 'grades.id')
        ->join('levels', 'level_id', '=', 'levels.id')
        ->where('year', current_school_year())->get();
    }

    public function save_day_of_week($array)
    {
        $string = implode(";", $array);
        return $string; //  select('name')->where('year');
    }
}
