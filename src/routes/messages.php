<?php

Route::name('messages.')->prefix('messages/')->group(function () {
    Route::get('/', 'MessageController@index');
});
