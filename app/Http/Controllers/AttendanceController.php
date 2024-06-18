<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
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

        $attendancePercentage = 0;

        $totalClasses = Calendar::count();

        if ($attendances_count && $totalClasses) {
            $attendancePercentage = round(($attendances_count / $totalClasses) * 100);
        }
        return [
            'Attendance_count' => $attendances_count,
            'Attendance_percentage' => $attendancePercentage,
        ];
    }
}
