<?php

namespace App\Models;

use App\Models\Question;
use App\Models\Curriculum;
use App\Models\QuestionBankType;
use App\Models\QuestionBankDifficulty;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuestionBank extends Model
{
    use HasFactory;
    protected $fillable=
    [
        'name',
        'Chapters',
        'curriculum_id',
        'question_bank_type_id',
        'question_bank_difficulty_id',
        'short_description',
        'questions_data'
    ];

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class, 'curriculum_id');
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function type()
    {
        return $this->belongsTo(QuestionBankType::class, 'question_bank_type_id');
    }

    public function difficulty()
    {
        return $this->belongsTo(QuestionBankDifficulty::class, 'question_bank_difficulty_id');
    }
}
