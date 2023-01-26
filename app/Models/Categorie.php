<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    
    
    protected  $guarded = [];
    protected  $table = 'categories';
   
    protected $casts = [
        'certificate_id' => 'array',
        'callery' => 'array',
    ];
    
    // public function getStatusAttribute($value)
    // {
    //     return $value ==1? ''.__('site.is active').'':''.__('site.is not active');
    // }
    public function getActive(){
        return $this->status == 1 ? __('site.is active'):__('site.is not active');
    }
}
