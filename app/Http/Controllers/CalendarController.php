<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use App\Models\Calendar;
use Illuminate\Http\Request;
use App\Http\Resources\HolidayResource;
use App\Http\Resources\CalendarResource;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class CalendarController extends Controller
{
    // public function index()
    // {
    //     $calendars = Calendar::with('holidays')->get();
    //     return CalendarResource::collection($calendars);
    // }


    // public function getEvents(Request $request)
    // {
    //     $request->validate([
    //         'month' => 'required|integer|between:1,12',
    //         'year' => 'required|integer',
    //     ]);
    //     $month = $request->input('month');
    // $year = $request->input('year');

    //     // Calculate start and end date of the month
    //     $startOfMonth = "$year-$month-01";
    //     $endOfMonth = date('Y-m-t', strtotime($startOfMonth));

    //     // Fetch calendars
    //     $calendars = Calendar::where('start_time', '>=', $startOfMonth)
    //         ->where('end_time', '<=', $endOfMonth)
    //         ->get();

    //     // Fetch holidays
    //     $holidays = Holiday::where('date', '>=', $startOfMonth)
    //     ->where('date', '<=', $endOfMonth)
    //     ->get();


    //     // Transform data using resources
    //     $calendarEvents = CalendarResource::collection($calendars);
    //     $holidayEvents = HolidayResource::collection($holidays);

    //     return response()->json([
    //         'calendars' => $calendarEvents,
    //         'holidays' => $holidayEvents
    //     ]);
    // }
    public function fetchData(Request $request)
    {
        // Validate input parameters
        $request->validate([
            'month' => 'required|numeric|min:1|max:12',
            'year' => 'required|numeric|min:1970', // Assuming year should be greater than 1970
        ]);
    
        $month = $request->input('month');
        $year = $request->input('year');
    
        // Calculate start and end date based on month and year
        $startDate = "$year-$month-01";
        $endDate = date('Y-m-t', strtotime($startDate)); // trying to fetch the last date using the function date 
    
        
        $calendar = Calendar::with('curriculum')
            ->where('start_time', '>=', $startDate)
            ->where('end_time', '<=', $endDate)
            ->get();
    
    
        $calendar = CalendarResource::collection($calendar);
    
        
        $holidays = Holiday::where('date', '>=', $startDate)
            ->where('date', '<=', $endDate)
            ->get();
    
      
        $holidays = HolidayResource::collection($holidays);
    
    
        $mergedData = $calendar->merge($holidays);
    
       // Paginate the merged collection
    $perPage = $request->input('page_size', 2); // Default page size is 10
    $page = Paginator::resolveCurrentPage() ?: 1;
    $items = $mergedData->slice(($page - 1) * $perPage, $perPage)->values();
    $total = $mergedData->count();
    $start = ($page - 1) * $perPage + 1;
    $end = min($start + $perPage - 1, $total);
    $lastPage = ceil($total / $perPage);

    // Construct the pagination response
    $pagination = [
        'total' => $total,
        'page' => $page,
        'start' => $start,
        'end' => $end,
        'page_size' => $perPage,
    ];

    // Return the paginated data along with pagination information
    return [
        'data' => $items,
        'pagination' => $pagination,
    ];
    }
}
