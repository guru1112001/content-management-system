<?php

namespace App\Models;

use App\Models\Calendar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;
    protected $fillable = 
        ['branch_id', 'batch_id', 'tutor_id', 'subject', 'classroom_id', 'start_time', 'end_time'];
    

    public function calendar(): BelongsTo
    {
        return $this->belongsTo(Calendar::class);
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
