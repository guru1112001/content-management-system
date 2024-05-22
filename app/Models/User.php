<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Batch;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function leaveRequests()
{
    return $this->hasMany(LeaveRequest::class);
}

    public function isAdmin()
    {
        return $this->is_admin;
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'resume',
        'id_card', // Custom field: ID
        'info', // Custom field: Info
        'edu_docs', // Custom field: Edu docs
        'photo',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'edu_docs' => 'array',
    ];
    public function attendances()
    {
        return $this->hasMany(Attendance::class,'user_id');
    }
    public function batches()
    {
        return $this->belongsToMany(Batch::class, 'batch_users', 'user_id', 'batch_id');
    }
}
