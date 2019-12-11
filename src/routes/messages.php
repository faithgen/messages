<?php

use FaithGen\Messages\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::name('messages.')->prefix('messages/')->group(function () {
    Route::get('/', [MessageController::class, 'index']);
    Route::post('comment', [MessageController::class, 'comment']);
});
