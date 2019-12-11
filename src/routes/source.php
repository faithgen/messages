<?php

use FaithGen\Messages\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::name('messages.')->prefix('messages/')->group(function () {
    Route::post('/create', [MessageController::class, 'create'])->middleware('source.site');
    Route::post('/update', [MessageController::class, 'update'])->middleware('source.site');
    Route::delete('/delete', [MessageController::class, 'destroy'])->middleware('source.site');
});
