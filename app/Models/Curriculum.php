<?php

namespace App\Models;

use App\Models\Section;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Curriculum extends Model
{
    use HasFactory;
    
    protected $fillable=[
        'name',
        'short description',
        'image'
    ];

    public function Sections()
    {
        return $this->hasMany(Section::class);
    }
}
