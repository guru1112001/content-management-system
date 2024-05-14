<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Resources\BatchResource;
use App\Http\Resources\CourseResource;
use App\Models\batch_user;


class CourseController extends Controller
{
    public function getCourses(Request $request)
{
    $user = $request->user();

    $userId = $user->id; 

    $batchUsers = batch_user::with('batch.course_package')->where('user_id', $userId)->get();//first fetch the batch then related to that batch fetch course_package

    $courses = $batchUsers->pluck('batch.course_package'); // take the courses out  using pluck()

    return CourseResource::collection($courses);
}
}

// return new CourseResource($courses);
// $courses = Course::join('batch_courses', 'batch_courses.course_id', '=', 'courses.id')
//             ->join('batch_users', 'batch_users.batch_id', '=', 'batch_courses.batch_id')
//             ->where('batch_users.user_id', $user->id)
//             ->get();