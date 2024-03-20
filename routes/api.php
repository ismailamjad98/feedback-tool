<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedBackController;


Route::controller(FeedBackController::class)->prefix('feedback')->group(function () {
    Route::get('/', 'index');
    Route::post('/store', 'store');
    Route::delete('/delete/{id}', 'destroy');
    Route::post('/comment', 'postReply');
});

Route::get('/users' , [UserController::class , 'users']);
