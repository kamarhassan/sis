<?php

namespace App\Models;

use App\Models\StudentsRegistration;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable  //implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected  $guarded = [];

    // protected $fillable = [
    //     'name', 'email', 'midName', 'LastName',
    //     'password', 'MotherName', 'salut', 'fullname', 'birthday', 'birthday_id_place',
    //     'gender', 'identity_number', 'identity_type', 'segel', 'segel_place_id', 'nationality',
    //     'address_id', 'photo', 'work_type', 'work_address_id', 'status', 'email_verified_at'
    // ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cours()
    {
        return $this->belongsToMany(Cours::class, 'studentsregistrations', 'user_id', 'cours_id', 'id', 'id')
        ->withPivot('cours_fee_total', 'remaining','created_at');
    }

    public function cours_students_to_payment()
    {
        return $this->belongsToMany(Cours::class, 'studentsregistrations', 'user_id', 'cours_id', 'id', 'id')
        ->orderby('studentsregistrations.created_at','desc')
       ->with('grade:id,grade')
       ->with('level')
       ->withPivot('cours_fee_total', 'remaining','created_at')
       ;
    }




    public function payment()
    {
        return $this->belongsToMany(Payment::class, 'studentsregistrations', 'user_id', 'id', 'id', 'studentsRegistration_id' );
    }



    public function scopeGetIdByName($query, $name)
    {
        return $query->where('name', $name)->first()->id;
    }

    public function students_only()
    {
        return $this->hasMany(StudentsRegistration::class, 'user_id');
    }
}
