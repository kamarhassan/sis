<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;


    protected  $table = 'payments';

    protected  $guarded = [];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at'
    ];
    public function  cours_fee()
    {
        return $this->belongsTo(CoursFee::class, 'cours_fee_id', 'id')->with('fee_type', 'currency');
    }

}
