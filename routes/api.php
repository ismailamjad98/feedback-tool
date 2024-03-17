<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedBackController;


Route::controller(FeedBackController::class)->prefix('feedback')->group(function () {
    Route::get('/', 'index');
    Route::post('/store', 'store');
    Route::delete('/delete/{id}', 'destroy');
    Route::post('/comment', 'postReply');
});
