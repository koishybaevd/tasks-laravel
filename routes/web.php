<?php

Route::get('/', function () {
    return Redirect::to('/tasks');
});

Route::get('/tasks', 'TaskController@index');
Route::post('/tasks', 'TaskController@store');
Route::delete('/tasks/{task}', 'TaskController@destroy');
Route::post('/tasks/{task}/toggle', 'TaskController@toggle');
Route::post('/tasks/complete', 'TaskController@completeAll');
Route::post('/tasks/clear', 'TaskController@destoryCompleted');