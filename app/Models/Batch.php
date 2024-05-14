<?php

namespace App\Models;

use App\Models\batch_user;
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
    public function batch_users()
    {
        return $this->hasMany(batch_user::class);
    }
    public function course_package()
    {
        return $this->belongsTo(Course::class,'course_package_id');
    }
}
