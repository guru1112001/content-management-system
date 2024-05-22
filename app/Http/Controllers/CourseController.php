<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Course;
use App\Models\BatchUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\BatchResource;
use App\Http\Resources\CourseResource;


class CourseController extends Controller
{
    public function getCourses(Request $request)
{
    
    // $batches=Batch::get();
    // return CourseResource::collection($batches);

    $user = Auth::user();

    if (!$user) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    // Get batches the user is enrolled in
    $batches = $user->batches()->with('course_package')->get();

    // Collect courses from these batches
    $courses = $batches->map(function($batch) {
        return $batch->course_package;
    })->filter();
    if ($courses->isEmpty()) {
        return response()->json(['message' => 'You are not enrolled in any course.'], 200);
    }
    return CourseResource::collection($courses);
}

}

