<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    use HasFactory;

    protected  $table = 'sponsorships';

    protected $casts = [
        'fee_sponsored' => 'array',
        'percent' => 'array',
        'discount' => 'array',
    ];
    protected  $guarded = [];


    public function cours_for_sponsor()
    {
        return $this->hasMany(Cours::class, 'id', 'cours_id');
    }


    protected function fee_sponsored(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value),
            set: fn ($value) => json_encode($value),
        );
    }
    protected function percent(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value),
            set: fn ($value) => json_encode($value),
        );
    }
    protected function discount(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value),
            set: fn ($value) => json_encode($value),
        );
    }
}
