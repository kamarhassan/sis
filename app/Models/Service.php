<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected  $table = 'services';

    protected  $guarded = [];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function scopeActive($query){
        return $query->where('active',1);
    }

  
    public function currency()
    {
        return $this->hasOne(Currency::class, 'id', 'currencies_id');
    }
    public function getActive(){
        return $this->active == 1 ? __('site.is active'):__('site.is not active');
    }
}
