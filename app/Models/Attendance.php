<?php

namespace App\Models;

use App\Models\User;
use App\Models\Calendar;
use App\Enums\AttendanceStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','attendance_by','date','status'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function calendar()
    {
        return $this->belongsTo(Calendar::class,'calendar_id');
    }
    protected $casts = [
        'status' => AttendanceStatus::class,
        'date'=>'datetime',

    ];
}

