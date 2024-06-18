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
   $user = Auth::user();
    // Get batches the user is enrolled in
    // Retrieve the batches the user is enrolled in along with their courses and curriculums
    $batches = $user->batches()->with(['course_package', 'curriculums'])->get();

    $coursesWithCurriculum = [];

    foreach ($batches as $batch) {
        if ($batch->course_package_id) {
            $course = $batch->course_package;
            $curriculumIds = $batch->curriculums->pluck('id');

            foreach ($curriculumIds as $curriculumId) {
                $coursesWithCurriculum[] = [
                    'id' => $course->id,
                    'name' => $course->name,
                    'course_type' => $course->course_type,
                    'description' => $course->description,
                    'image_url' => $course->image_url,
                    'curriculum_id' => $curriculumId
                ];
            }
        }
    }
    
    if (empty($coursesWithCurriculum)) {
        return response()->json(['message' => 'You are not enrolled in any course.'], 200);
    }

    return response()->json($coursesWithCurriculum);

}

}

