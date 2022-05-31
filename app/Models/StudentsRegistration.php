<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentsRegistration extends Model
{
    use HasFactory;
    protected $table = 'studentsregistrations';

    protected  $guarded = [];
    protected $hidden = [
        'updated_at'
    ];

    public function student()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    public function cours()
    {
        return $this->hasone(Cours::class, 'id', 'cours_id')
            ->with('grade:id,grade')
            ->with('level:id,level');
    }


    public function  fee()
    {
        return $this->hasMany(CoursFee::class,'cours_id','id');
    }

}
