<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
   use HasFactory;


   protected $guarded = [];
   protected $table = 'categories';

   protected $casts = [
      'certificate_id' => 'array',
      'callery' => 'array',
      'tag' => 'array',

   ];

   // public function getStatusAttribute($value)
   // {
   //     return $value ==1? ''.__('site.is active').'':''.__('site.is not active');
   // }
   public function getActive()
   {
      return $this->status == 1 ? __('site.is active') : __('site.is not active');
   }


   public function grade()
   {
      return $this->belongsTo(Grade::class, 'grade_id', 'id');
   }

   public function level()
   {
      return $this->belongsTo(Level::class, 'level_id', 'id');
   }

   public function available_cours()
   {
      return $this->hasMany(Cours::class, 'categorie_id', 'id');
   }
 public function certificate()
   {
      return $this->belongsTo(Certificate::class, 'certificate_id', 'id');
   }

   protected function tag(): Attribute
   {
      return Attribute::make(
         get: fn ($value) => json_decode($value),
         set: fn ($value) => json_encode($value),
      );
   }
}
