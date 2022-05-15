<?php

namespace App\Models;

use App\Models\Cours;
use App\Repository\Fee_Type\Fee_TypeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoursFee extends Model
{
    use HasFactory;


    protected $table = 'cours_fees';

    protected  $guarded = [];
    protected $hidden = [
        'created_at', 'updated_at'
    ];



    public function scopeGetOrFail($query)
    {
        if (empty($query->count())) {
            return false;
        } else {
            return $query->get();
        }
    }



    public function  cours()
    {
        return $this->belongsTo(Cours::class, 'cours_id', 'id');
    }

    public function  currency()
    {
        return $this->belongsTo(currency::class, 'currencies_id', 'id');
    }

    public function  fee_type()
    {
        return $this->belongsTo(fee_type::class, 'fee_types_id', 'id');
    }


    /***
     * end of class
     */
}
