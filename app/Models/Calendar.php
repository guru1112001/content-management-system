<?php

namespace App\Models;

use App\Models\Item;
use App\Models\User;
use App\Models\Batch;
use App\Models\Branch;
use App\Models\Holiday;
use App\Models\Classroom;
use App\Models\Curriculum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Calendar extends Model
{
    protected $fillable = [
        'team_id',
        'batch_id',
        'tutor_id',
        'curriculum_id',
        'classroom_id',
        'start_time',
        'end_time',
    ];

    protected $casts = [
        'start_time' => 'datetime', // Ensure start_time is cast to a DateTime object
        'end_time'=>'datetime',
    ];
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class);
    }

    // public function holidays()
    // {
    //     $calendars = Calendar::with('holidays')->get();
    //   }
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

    public function attendances()
    {
        return $this->hasMany(Attendance::class,'calendar_id');
    }

    public function items():HasMany 
    {
        return $this->hasMany(Item::class, 'calendar_id');
    }
}
