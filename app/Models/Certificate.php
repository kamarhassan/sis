<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;
        protected  $guarded = [];
        protected  $table = 'certificates';

   protected $casts = [
      'categorie_id' => 'array',
     
      
   ];

    public function categories()
    {
        return $this->belongsToMany(Categorie::class, 'categorie_id', 'id');
    }
}
