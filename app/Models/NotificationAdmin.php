<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotificationAdmin extends Model
{
   use HasFactory;
   use HasFactory;


   protected  $table = 'notification_admins';
   
   protected  $guarded = [];
   
   
   // protected function teachType(): Attribute
   // {
   //    return new Attribute(

   //       get: fn ($value) => ($value == 1) ? 'online' : 'offline',
   //    );
   // }

   public function getTeachType(){
      return $this->teach_type == 1 ? 'online': 'offline';
  }
   public function cours_reserved()
   {
      return $this->belongsTo(Cours::class, 'order_id', 'id')->with('category_grade_level');
   }
   public function user()
   {
      return $this->hasOne(User::class, 'id', 'user_id');
   }
   public function service()
   {
      return $this->hasOne(Service::class, 'id', 'order_id');
   }

}
