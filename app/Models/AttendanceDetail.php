<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceDetail extends Model
{
    use HasFactory;
    protected  $guarded = [];
    protected  $table = 'attendance_details';


    public function attendance_info(){
        return $this->belongsTo(AttendanceInfo::class,  'id','attendance_info_id');
    }
}
