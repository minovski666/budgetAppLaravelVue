<?php
Route::get('/records', 'RecordController@index')->name("records.index");
Route::get('/records/all', 'RecordController@getRecords');

Route::get('/records/create', 'RecordController@create')->name("records.create");
Route::post('/records/store', 'RecordController@store');
Route::get('/records/delete/{id}', 'RecordController@destroy');

Route::any('/records/balance', 'RecordController@balance');


