<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;
        protected  $guarded = [];
        protected  $table = 'certificates';

    protected $casts = [
        'levels' => 'array',
    ];
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'id');
    }
    public function levels()
    {
        return $this->belongsTo(Level::class, 'levels', 'id');
    }
}
