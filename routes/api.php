<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\StateController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/cities', [CityController::class, 'index']);
    Route::get('/states', [StateController::class, 'index']);
    Route::get('/qualification', [QualificationController::class, 'index']);

    
    Route::post('password/change', [PasswordResetController::class, 'changePassword'])->middleware('auth:sanctum');

});

Route::put('/user', [UserController::class, 'update']);

Route::get('/user', function (Request $request) {
    return $request->user();
});
// Authentication Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register',[AuthController::class,'register']);