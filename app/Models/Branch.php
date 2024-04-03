<?php

namespace App\Models;

use App\Models\Calendar;
use App\Models\Classroom;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branch extends Model
{
    protected $fillable = ['name'];

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }

    public function calendars()
    {
        return $this->hasMany(Calendar::class);
    }
}
