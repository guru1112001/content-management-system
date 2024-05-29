<?php

namespace App\Models;

use App\Models\User;
use App\Models\Batch;
use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Syllabus extends Model
{
    use HasFactory;

    protected $fillable=[
        'Day',
        'Batch_id',
        'Course_id',
        'Syllabus',
        'SSTA',
        'User_id',
        'Date',
        'Status',
        'comments'
    ];
    public function batch()
    {
        return $this->belongsTo(Batch::class); 
    }

   
    public function course()
    {
        return $this->belongsTo(Course::class); 
    }

    public function tutor()
    {
        return $this->belongsTo(User::class, 'User_id');
    }

}
