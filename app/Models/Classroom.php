<?php

namespace App\Models;

use App\Models\Branch;
use App\Models\Calendar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classroom extends Model
{
    protected $fillable = ['name', 'branch_id'];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function calendars()
    {
        return $this->hasMany(Calendar::class);
    }
}
