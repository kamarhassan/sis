<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use Notifiable;
use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'acount_id', 'midName', 'LastName',
        'password', 'MotherName', 'salut', 'fullname', 'birthday', 'birthday_id_place',
        'gender', 'identity_number', 'identity_type', 'segel', 'segel_place_id', 'nationality',
        'address_id', 'photo', 'work_type', 'work_address_id', 'status', 'email_verified_at'
    ];
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



    public function scopeSelecte()
    {

    }
}
