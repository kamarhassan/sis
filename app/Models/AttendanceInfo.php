<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceInfo extends Model
{
    use HasFactory;
    protected  $guarded = [];
    protected  $table = 'attendance_infos';
    
    public function attendance_details(){
        return $this->belongsTo(AttendanceDetail::class, 'attendance_info_id', 'id');
    }
    // return $this->belongsTo('App\Models\Level', 'level_id', 'id');
}
