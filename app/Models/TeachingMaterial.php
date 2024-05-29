<?php

namespace App\Models;

use App\Models\Section;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeachingMaterial extends Model
{
    use HasFactory;
    protected $fillable = [
        'section_id', 'name', 'material_source', 'file', 'content', 
        'unlimited_view', 'maximum_views', 'prerequisite', 'description', 
        'privacy_allow_access', 'privacy_downloadable', 'published', 'sort', 
        'doc_type', 'maximum_marks', 'passing_percentage', 'result_declaration', 
        'maximum_attempts', 'general_instructions', 'start_submission', 
        'stop_submission'
    ];
    public function section()
    {
       return $this->belongsTo(Section::class,'section_id');
    }
}
