<?php

namespace App\Models;

use App\Models\Batch;
use App\Models\Curriculum;
use App\Models\TeachingMaterial;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'short description',
    ];
    
    public function batches()
    {
        return $this->belongsToMany(Batch::class, 'batch_sections', 'section_id', 'batch_id');
    }
    public function teachingMaterials()
    {
        return $this->hasMany(TeachingMaterial::class,'section_id');

    }
}
