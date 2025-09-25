<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('landing');
});

Route::get('/register', [RegisterController::class, 'view'])->name('register.view');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');
