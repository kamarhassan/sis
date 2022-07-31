<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceReceipt extends Model
{
    use HasFactory;


    protected  $table = 'service_receipts';

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


    public function client_services()
    {
        return $this->belongsTo(UserService::class, 'user_service_id', 'id');
    }
    public function services_()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    //     "": 3,
    // "": 3,
    public function services_currency()
    {
        return $this->belongsTo(Currency::class, 'service_currency_id', 'id');
    }
    public function client_paid_currency()
    {
        return $this->belongsTo(Currency::class, 'currencies_id', 'id');
    }
}
