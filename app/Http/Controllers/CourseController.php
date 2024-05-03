<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Resources\CourseResource;

class CourseController extends Controller
{
    public function getCourses(Request $request)
{
    $user = $request->user();

    // Retrieve the courses associated with the user's enrolled batches
    $courses = Course::whereIn('id', function ($query) use ($user) {
        $query->select('course_id')
              ->from('batch_courses')
              ->whereIn('batch_id', function ($query) use ($user) {
                  $query->select('batch_id')
                        ->from('batch_users')
                        ->where('user_id', $user->id);
              });
    })->get();

    return CourseResource::collection($courses);
}
}
