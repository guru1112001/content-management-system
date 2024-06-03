<?php

namespace App\Models;

use App\Models\Section;
use App\Models\QuestionBank;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Curriculum extends Model
{

    use HasFactory;
    protected $table = 'curriculum';
    
    protected $fillable=[
        'name',
        'short description',
        'image'
    ];

    public function Sections()
    {
        return $this->hasMany(Section::class,'section_id');
    }

    public function questionBanks()
    {
        return $this->hasMany(QuestionBank::class, 'curriculum_id');
    }
}
