<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurTeam extends Model
{
    use HasFactory;
    protected  $guarded = [];

  


   public function info(){
       return $this->hasOne(Admin::class,'id','instructor');
    }
    
}
