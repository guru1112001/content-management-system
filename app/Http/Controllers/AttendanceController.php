<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Resources\AttendanceResource;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
   

    $attendances_count = Attendance::where('user_id', $user->id)
        ->count();
    $attendances=Attendance::where('user_id',$user->id)->get();
    $attendances=AttendanceResource::collection($attendances);
        // $merge=$attendances->merge($attendances_count);
       
        return [
            'count'=>$attendances_count,
            'data'=>$attendances,
        ];
    }
}
