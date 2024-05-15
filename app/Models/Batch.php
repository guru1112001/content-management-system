<?php

namespace App\Models;

use App\Models\BatchUser;
use App\Models\Calendar;
use App\Models\BatchCourse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Batch extends Model
{
    protected $fillable = ['name','course_package_id'];

    public function calendars()
    {
        return $this->hasMany(Calendar::class);
    }
    public function batchCourses()
    {
        return $this->hasMany(BatchCourse::class);
    }
    public function BatchUsers()
    {
        return $this->hasMany(BatchUser::class);
    }
    public function course_package()
    {
        return $this->belongsTo(Course::class,'course_package_id');
    }
}
