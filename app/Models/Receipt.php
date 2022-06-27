<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;
    protected  $table = 'receipts';

    protected  $guarded = [];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'updated_at'
    ];


    public function  StdRegistration()
    {
        return $this->belongsTo(StudentsRegistration::class,'studentsRegistration_id','id')
        ->with('cours');
    }


    public function  students()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }




}
