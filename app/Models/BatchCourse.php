<?php

namespace App\Models;

use App\Models\Batch;
use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BatchCourse extends Model
{
    use HasFactory;
    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
