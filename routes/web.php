<?php

use App\Models\Content;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ContentController;
use App\Utilities\PdfWatermark;
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
    $filePath = public_path('storage/' . $content->file_path);
    
    // Check if the file exists
    if (file_exists($filePath)) {
        // Check if 'preview' query parameter is set to 'true'
        if (request()->query('preview')) {
            // If preview mode is enabled, render the PDF in the browser
            return Response::file($filePath);
        } else {
            // Otherwise, serve the file for download
            return response()->download($filePath);
        }
    } else {
        // File does not exist, return 404 Not Found
        abort(404);
    }
})->name('download.file')->middleware('auth');
Route::get('/preview-pdf/{content}', function (Content $content) {
    // Construct the file path from the Content model's file_path attribute
    // $filePath = asset(public_path('storage/' . $content->file_path));
    // $filePath = asset('storage/'. $content->file_path);
    $filePath = asset('storage/' . $content->file_path);
    echo($filePath);
    
    return view('pdf.preview', ['filePath' => $filePath]);
})->name('preview.pdf');