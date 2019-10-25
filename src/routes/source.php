<?php
Route::name('messages.')->prefix('messages/')->group(function () {
    Route::post('/create', 'MessageController@create')->middleware('source.site');
    Route::post('/update', 'MessageController@update')->middleware('source.site');
    Route::delete('/delete', 'MessageController@destroy')->middleware('source.site');
});
