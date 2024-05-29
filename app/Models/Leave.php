<?php

namespace App\Models;

use App\Models\User;
use App\Enums\LeaveStatus;
use App\Observers\LeaveObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

// #[ObservedBy([LeaveObserver::class])]
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
//     public function boot()
// {
//     Leave::observe(LeaveObserver::class);
// }
protected static function boot()
    {
        parent::boot();

        // Register the observer here if you prefer
        static::observe(LeaveObserver::class);
    }
}
