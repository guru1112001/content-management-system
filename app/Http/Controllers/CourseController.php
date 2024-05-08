<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Resources\BatchResource;
use App\Http\Resources\CourseResource;

class CourseController extends Controller
{
    public function getCourses(Request $request)
{
    $user = $request->user();

    // Retrieve the courses associated with the user's enrolled batches
    // $courses = Course::whereIn('id', function ($query) use ($user) {
    //     $query->select('course_id')
    //           ->from('batch_courses')
    //           ->whereIn('batch_id', function ($query) use ($user) {
    //               $query->select('batch_id')
    //                     ->from('batch_users')
    //                     ->where('user_id', $user->id);
    //           });
    // })->get();
    $courses = Course::join('batch_courses', 'batch_courses.course_id', '=', 'courses.id')
                ->join('batch_users', 'batch_users.batch_id', '=', 'batch_courses.batch_id')
                ->where('batch_users.user_id', $user->id)
                ->get();

    
    // $batches= Batch::select('batches.id','batches.name')
    // ->join('batch_users','batch_users.batch_id','=','batches.id')
    // ->where('batch_users.user_id',$user->id)
    // ->get();


    // $batch_data=BatchResource::collection($batches);
    return CourseResource::collection($courses);
    
}
}
