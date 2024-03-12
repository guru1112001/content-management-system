<?php

use App\Models\Content;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\DownloadController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/files/download/{id}', [ContentController::class, 'download'])->name('files.download');

Route::get('/download-content/{content}', function (Content $content) {
    // Construct the file path from the Content model's file_path attribute
    // $filePath = $content->file_path;
    // echo($filePath);
    // // Check if the file exists
    // if (Storage::exists($filePath)) {
    //     // File exists, return download response
    //     return Storage::download($filePath);
    // } else {
    //     // File does not exist, return 404 Not Found
    //     abort(404);
    $filePath = public_path('storage/' . $content->file_path);
    
    // Check if the file exists
    if (file_exists($filePath)) {
        // File exists, serve the file for download
        return response()->download($filePath);
    } else {
        // File does not exist, return 404 Not Found
        abort(404);
    }
})->name('download.file')->middleware('auth');