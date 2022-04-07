<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table ='languages';

    protected $fillable = [ 'id', 'name','script','native','regional','country','code','active','direction', 'created_at','updated_at'];

    protected $hidden = [
        'created_at','updated_at'
    ];

        public function scopeActive($query){
            return $query->where('active',1);
        }

        public function scopeSelection($query){
            return $query->select('name','active','code','direction');
        }

        public function getActive(){
            return $this->active == 1 ? __('site.language is active'):__('site.language is not active');
        }
}
