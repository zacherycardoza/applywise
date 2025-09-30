<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\SettingsController;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/register', [RegisterController::class, 'view'])->name('register.index');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/login', [LoginController::class, 'view'])->name('login.index');
Route::post('/login', [LoginController::class, 'login'])->name('login');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'view'])->name('dashboard');

    Route::post('/resume', [ResumeController::class, 'upload'])->name('resume.upload');
    Route::get('/resumes', [ResumeController::class, 'index'])->name('resumes.index');
    Route::delete('/resumes/{resume}', [ResumeController::class, 'destroy'])->name('resumes.destroy');

    Route::get('/scans', [ScanController::class, 'index'])->name('scans.index');
    Route::get('/scan/{scan}', [ScanController::class, 'show'])->name('scans.show');
    Route::post('/scan', [ScanController::class, 'scan'])->name('scan');

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings/updateProfile', [SettingsController::class, 'updateProfile'])->name('settings.updateProfile');
    Route::post('/settings/updatePassword', [SettingsController::class, 'updatePassword'])->name('settings.updatePassword');
    Route::delete('/settings/deleteAccount', [SettingsController::class, 'deleteAccount'])->name('settings.deleteAccount');
});




Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');
