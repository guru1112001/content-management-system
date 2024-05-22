<?php

namespace App\Models;

use App\Models\User;
use App\Models\Calendar;
use App\Models\BatchUser;
use App\Models\BatchCourse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

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

    public function students()
    {
        return $this->belongsToMany(
            User::class,
            'batch_user',
            'user_id',
            'batch_id'
        )
            ->where('role_id', 6);
    }
    protected static function booted(): void
    {
        static::addGlobalScope('limited', function (Builder $query) {
            if (auth()->check() && auth()->user()->is_student) {
                $query->whereHas('students');
            }
        });
    }
}
