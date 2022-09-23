<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationAdmin extends Model
{
    use HasFactory;
    use HasFactory;


    protected  $table = 'notification_admins';

    protected  $guarded = [];


    public function cours_reserved()
    {
        return $this->belongsTo(Cours::class, 'order_id', 'id')->with('grade')->with('level');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
