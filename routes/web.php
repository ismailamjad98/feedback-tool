<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/login', function () {
//     return view('Auth.login');
// });

Route::get('/dashboard', function () {
    return view('home');
});
Route::get('/feedback', function () {
    return view('feedback');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
