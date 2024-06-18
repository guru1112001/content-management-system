<?php

namespace App\Models;

use App\Observers\NotificationObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    protected $table = 'notifications';
    use HasFactory;

    protected $casts = [
        'data' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        static::observe(NotificationObserver::class);
    }

    public function notifiable()
    {
        return $this->morphTo();
    }
}