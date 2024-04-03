<?php

namespace App\Models;

use App\Models\User;
use App\Models\Batch;
use App\Models\Branch;
use App\Models\Classroom;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Calendar extends Model
{
    protected $fillable = ['branch_id', 'batch_id', 'tutor_id', 'subject', 'classroom_id', 'start_time', 'end_time'];
    
    public function holidays()
    {
        return $this->hasMany(Holiday::class);
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
}
