<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use App\Models\Calendar;
use Illuminate\Http\Request;
use App\Http\Resources\HolidayResource;
use App\Http\Resources\CalendarResource;

class ApiController extends Controller

{

    private $month;
    private $year;

    

    public function getCalendarData(Request $request)
    {
        // Validate the incoming request parameters
        $request->validate([
            'month' => 'required|integer|between:1,12',
            'year' => 'required|integer',
        ]);
        
        // $this->month = $request->month;
        // $this->year = $request->year;

        // Retrieve calendar data for the specified month and year
        $calendars = Calendar::with('curriculum')
        ->whereMonth('start_time', $request->month)
        ->whereYear('start_time', $request->year)
        ->get();

        // Transform the calendar data using a resource
        $calendarData = CalendarResource::collection($calendars);

        // Return the transformed data as a JSON response
        return response()->json($calendarData);
    }

    public function getCalendarDataByDay(Request $request)
    {
        // Validate the incoming request parameter
        $request->validate([

            'day' => 'required|integer|between:1,31',
            'month' => 'required|integer|between:1,12',
            'year' => 'required|integer',
        ]);

        // Retrieve calendar data for the specified day, month, and year
        $calendar = Calendar::with('curriculum')
                            ->whereDay('start_time', $request->day)
                            ->whereMonth('start_time',$request->month)
                            ->whereYear('start_time', $request->year)
                            ->get();

        // Transform the calendar data using a resource
        $calendarData = CalendarResource::collection($calendar);

        // Return the transformed data as a JSON response
        return response()->json($calendarData);
    }

}
