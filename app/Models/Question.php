<?php

namespace App\Models;

use App\Models\Option;
use App\Models\QuestionBank;
use App\Models\QuestionBankType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['question_bank_id', 'question_text', 'marks', 'negative_marks', 'question_type'];

    public function questionBank()
    {
        return $this->belongsTo(QuestionBank::class);
    }

    public function type()
    {
        return $this->belongsTo(QuestionBankType::class, 'question_bank_type_id');
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
