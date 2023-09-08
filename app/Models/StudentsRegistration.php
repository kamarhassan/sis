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


   protected $casts = [
      'feesRequired' => 'array',
      'teams_info' => 'array',
   ];

   public function student()
   {
      return $this->hasMany(User::class, 'id', 'user_id');
   }

   public function cours()
   {
      return $this->hasone(Cours::class, 'id', 'cours_id')
         ->with('category_grade_level')
         
         ->with('cours_currency')
         ->with('teacher_name');
   }


   public function  fee()
   {
      return $this->hasMany(CoursFee::class, 'cours_id', 'id');
   }

   protected function feesRequired(): Attribute
   {
      return Attribute::make(
         get: fn ($value) => json_decode($value),
         set: fn ($value) => json_encode($value),
      );
   }



   // protected function teachType(): Attribute
   // {
   //    return new Attribute(

   //       get: fn ($value) => ($value == 1) ? 'online' : 'offline',
   //    );
   // }

   public function getTeachType()
   {
      return $this->registration_type == 1 ? 'online' : 'offline';
   }
}
