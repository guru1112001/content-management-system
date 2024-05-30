<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionBankDifficulty extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function questionBanks()
    {
        return $this->hasMany(QuestionBank::class, 'question_bank_difficulty_id');
    }
}
