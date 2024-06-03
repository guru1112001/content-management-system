<?php

use App\Models\Content;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ContentController;
use App\Utilities\PdfWatermark;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\FolderController;


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
Route::get('/admin/check-session', function () {
    return response()->json([
        'session_valid' => Auth::check(),
    ]);
});
use App\Filament\Pages\ViewQuestions;

Route::get('/view-questions/{questionBank}', ViewQuestions::class)->name('filament.pages.view-questions');

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
// Route::get('/preview-pdf/{content}', function (Content $content) {
//     $filePath = asset('storage/' . $content->file_path);
    
    
//     return view('pdf.preview', ['filePath' => $filePath]);
// })->name('preview.pdf');


// Route::get('/preview-pdf/{content}', function (Content $content) {
//     $model = Content::findOrFail($content->id);
// $filePath = storage_path('app/' . $model->file_name);
// echo($filePath);
// if (File::exists($filePath)) {
//     $fileContents = File::get($filePath);
//     return Response::make($fileContents, 200, [
//         'Content-Type' => 'application/pdf',
//     ]);
// } else {
//     abort(404); // File not found
// } 
//    return view('pdf.preview', ['filePath' => $filePath]);

// })->name('preview.pdf');

// Route::get('/preview-document/{file}', [ContentController::class,'preview'])->name('content.preview');
Route::get('preview/{id}', [ContentController::class,'preview'])->name('preview');




Route::get('/subjects/{subject}', [SubjectController::class, 'showFolders'])->name('subjects.showFolders');
Route::get('/folders/{folder}', [FolderController::class, 'showContents'])->name('folders.showContents');

// Route::get('/folders/{folder}', [FolderController::class,'show'])->name('folders.show');


Route::delete('/folders/{folder}', [FolderController::class,'destroy'])->name('folders.destroy');
