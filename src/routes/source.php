<?php

use FaithGen\Messages\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::name('messages.')
    ->prefix('messages/')
    ->middleware('source.site')
    ->group(function () {
        Route::post('/create', [MessageController::class, 'create']);
        Route::post('/update', [MessageController::class, 'update']);
        Route::delete('/delete', [MessageController::class, 'destroy']);
    });
