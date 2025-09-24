<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('landing');
});

Route::get('/register', [RegisterController::class, 'view'])->name('register.view');
