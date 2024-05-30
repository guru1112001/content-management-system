<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionBankType extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function questions()
    {
        return $this->hasMany(Question::class, 'question_bank_type_id');
    }

    public function questionBanks()
    {
        return $this->hasMany(QuestionBank::class, 'question_bank_type_id');
    }
}
