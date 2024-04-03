<?php

namespace App\Models;

use App\Models\Calendar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Batch extends Model
{
    protected $fillable = ['name'];

    public function calendars()
    {
        return $this->hasMany(Calendar::class);
    }
}
