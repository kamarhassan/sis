<?php

namespace App\Models;

use App\Models\StudentsRegistration;
use Database\Seeders\students_registartion;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
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
        return $this->belongsToMany(Cours::class, 'studentsregistrations', 'user_id', 'cours_id', 'id', 'id');
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
