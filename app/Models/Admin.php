<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use phpDocumentor\Reflection\Types\This;
use Spatie\Permission\Traits\HasRoles;
class Admin extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected  $guarded = [];
    protected  $table = 'admins';


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','created_at','updated_at'
    ];

    protected $casts =[
        'roles_name' =>'array'
    ];



    public function scopeGetIdByName($query, $name)
    {
        return $query->where('name', $name)->first()->id;
    }
    
}
