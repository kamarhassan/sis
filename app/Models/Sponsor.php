<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;


    public function scopeSelection($query)
    {
        return $query->where('blocked', 0)->select('type', 'name', 'budgetLimit', 'studentLimit', 'defaultpercent');
    }
}
