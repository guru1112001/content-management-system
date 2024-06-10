<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\FolderController;

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


use App\Filament\Pages\ChangePassword;

Route::get('/admin/users/{user}/change-password', ChangePassword::class)
    ->name('filament.page.change-password');