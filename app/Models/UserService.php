<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserService extends Model
{
    use HasFactory;
    protected $table ='user_services';

    protected  $guarded = [];
    protected $hidden = [
        'created_at','updated_at'
    ];


    public function client()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

}
