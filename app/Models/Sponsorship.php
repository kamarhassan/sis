<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    use HasFactory;
    
    protected  $table = 'sponsorships';

    protected  $guarded = [];


    public function cours_for_sponsor(){
        return $this->hasMany(Cours::class,'id','cours_id');
    }


}
