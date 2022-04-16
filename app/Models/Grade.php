<?php

namespace App\Models;
use App\Models\Cours;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    // use Notifiable;
    // use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table ='grades';

    protected  $guarded = [];

    protected $hidden = [
        'created_at','updated_at'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */



    public function scopeSelection($query){
        return $query->select('grade');
    }


    public function scopeGetIdByName($query, $name)
    {
        return $query->where('grade', $name)->first()->id;
    }


    public  function cours(){
        return $this->hasMany(Cours::class,'grade_id','id');
    }

}
