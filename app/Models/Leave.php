<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\LeaveStatus;

class Leave extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','Student', 'start_date', 'end_date', 'reason', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $casts = [
        'status' => LeaveStatus::class,
    ];
}
