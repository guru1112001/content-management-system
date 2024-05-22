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
        return $this->belongsTo(Batch::class); // Replace 'Batch' with your actual model name
    }

    // Relationship with Course model (assuming a syllabus belongs to one course)
    public function course()
    {
        return $this->belongsTo(Course::class); // Replace 'Course' with your actual model name
    }

    public function tutor()
    {
        return $this->belongsTo(User::class, 'User_id');
    }

}
