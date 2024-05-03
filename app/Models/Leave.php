<?php

namespace App\Models;

use App\Models\User;
use App\Enums\LeaveStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Leave extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'reason',
        'status',
        'updated_by',
    ];

    // Define relationships if needed, for example:
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $casts = [
        'status' => LeaveStatus::class,
    ];
}
