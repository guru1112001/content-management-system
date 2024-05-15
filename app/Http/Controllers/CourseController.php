<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Resources\BatchResource;
use App\Http\Resources\CourseResource;
use App\Models\BatchUser;


class CourseController extends Controller
{
    public function getCourses(Request $request)
{
    // $user = $request->user();

    // $userId = $user->id; 

    // $batchUsers = BatchUser::with('batch.course_package')->where('user_id', $userId)->get();//first fetch the batch then related to that batch fetch course_package

    // $courses = $batchUsers->pluck('batch.course_package'); // take the courses out  using pluck()

    $batches=Batch::get();
    return CourseResource::collection($batches);
    
}
}

// return new CourseResource($courses);
// $courses = Course::join('batch_courses', 'batch_courses.course_id', '=', 'courses.id')
//             ->join('BatchUsers', 'BatchUsers.batch_id', '=', 'batch_courses.batch_id')
//             ->where('BatchUsers.user_id', $user->id)
//             ->get();