<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $table ='currencies';

    protected  $guarded = [];
    protected $hidden = [
        'created_at','updated_at'
    ];

    public function scopeSelection($query){

        return $query ->select('currency','abbr','Country','Symbol','active');
    }
    public function scopeDescending($query)
{
        return $query->orderBy('active','DESC');
}

public function scopeActive($query){
    return $query->where('active',1);
}
    public function getActive(){
        return $this->active == 1 ? __('site.is active'):__('site.is not active');
    }

}
