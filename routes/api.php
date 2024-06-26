<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\SyllabusController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\QualificationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/send-notification', [NotificationController::class, 'sendNotification']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/cities', [CityController::class, 'index']);
    Route::get('/states', [StateController::class, 'index']);
    Route::get('/qualification', [QualificationController::class, 'index']);
   
   
    Route::get('/users', [UserController::class, 'getUsersByIds']);
    // api for listing batches
    Route::get('/batches',[BatchController::class,'get_batches']);

    //api for listing the syllabus
    Route::get('/Syllabus',[SyllabusController::class,'getUserSyllabus']);

    //api for listing course
    Route::get('/courses', [CourseController::class,'getCourses']);

    //api for applying the leave and listing
    Route::post('/leaves/apply', [LeaveController::class, 'applyLeave']);
    Route::get('/leaves/list',[LeaveController::class,'index']);

    //api for veiwing the calendar schedule and holidays
    Route::get('/calanders/list', [CalendarController::class, 'fetchData']);

    // api for listing attendance
    Route::get('/attendances', [AttendanceController::class, 'index']);

    //api for listing teaching material 
    Route::get('/teachingMaterial',[SectionController::class,'GetTeachingMaterial']);
    //api for listing for sections
    Route::get('/sections',[SectionController::class,'getsections']);

    //api for listing annoucements
    Route::get('/announcements',[AnnouncementController::class,'index']);

    //api for notifications
    Route::get('/notifications',[NotificationController::class,'index']);

    Route::post('/notifications/mark-read/{id}', [NotificationController::class, 'markAsRead']);

    Route::delete('/notifications/{id}', [NotificationController::class, 'delete']);

    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead']);
    
    Route::get('/notifications/count', [NotificationController::class, 'count']);
    
    Route::post('password/change', [PasswordResetController::class, 'changePassword'])->middleware('auth:sanctum');

});

Route::put('/user', [UserController::class, 'update']);

Route::get('/user', function (Request $request) {
    return $request->user();
});
// Authentication Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register',[AuthController::class,'register']);