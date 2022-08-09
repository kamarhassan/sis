<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;
    protected  $table = 'receipts';

    protected  $guarded = [];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'updated_at'
    ];


    public function  StdRegistration()
    {
        return $this->belongsTo(StudentsRegistration::class, 'studentsRegistration_id', 'id')
            ->with('cours');
    }

  

    public function  students()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function registartion()
    {
        return $this->belongsTo(StudentsRegistration::class, 'studentsRegistration_id', 'id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'id', 'receipt_id');
        // ->with('cours_fee');
    }


    public function currency()
    {
        return $this->hasOne(currency::class, 'id', 'currencies_id');
    }
    public function cours_currency()
    {
        return $this->hasOne(currency::class, 'id', 'cours_currency_id');
    }
}
