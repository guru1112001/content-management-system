<?php

namespace App\Models;

use App\Models\BatchCourse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;
    public function batchCourses()
    {
        return $this->hasMany(BatchCourse::class);
    }
}
