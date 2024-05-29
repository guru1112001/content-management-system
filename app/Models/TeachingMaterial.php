<?php

namespace App\Models;

use App\Models\Section;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeachingMaterial extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'file',
        'published',
        'section_id'
    ];
    public function section()
    {
       return $this->belongsTo(Section::class);
    }
}
