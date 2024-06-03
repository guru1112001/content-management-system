<?php

namespace App\Models;

use App\Models\User;
use App\Models\Section;
use App\Models\Calendar;
use App\Models\BatchUser;
use App\Models\Curriculum;
use App\Models\BatchCourse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
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

    public function students()
    {
    return $this->belongsToMany(
        User::class,
        'batch_users',
        'batch_id',
        'user_id'
    );
    
    }
protected static function booted(): void
    {
    static::addGlobalScope('limited', function (Builder $query) {
        if (auth()->check() && auth()->user()->is_admin) {
            $query->whereHas('students');
        }
    });
    }
    public function sections()
    {
        return $this->belongsToMany(Section::class, 'batch_sections', 'batch_id', 'section_id');
    }

    public function curriculums()
    {
        return $this->belongsToMany(Curriculum::class, 'batch_curriculum', 'batch_id', 'curriculum_id');
    }
}
