<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;
    protected $fillable = ['name','calendar_id', 'date'];

    public function calendar()
    {
        return $this->belongsTo(Calendar::class);
    }
}