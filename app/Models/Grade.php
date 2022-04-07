<?php

namespace App\Models;

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
        return $query->select('name');
    }


}
