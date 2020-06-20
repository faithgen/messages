<?php

use FaithGen\Messages\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::name('messages.')->prefix('messages/')->group(function () {
    Route::get('/', [MessageController::class, 'index']);
    Route::get('comments/{message}', [MessageController::class, 'comments']);
    Route::post('comment/{message}', [MessageController::class, 'comment']);
});
