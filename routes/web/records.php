<?php
Route::get('/records', 'RecordController@index')->name("records.index");
Route::get('/records/all', 'RecordController@getRecords');

Route::get('/records/filters', 'RecordController@showFilters')->name("records.filters");
Route::post('/records/store', 'RecordController@store');
Route::any('/records/edit/{id}', 'RecordController@edit');

Route::get('/records/delete/{id}', 'RecordController@destroy');
Route::get('/records/filters/{from}/{to}', 'RecordController@select');
Route::get('/records/filters/balance/{from}/{to}', 'RecordController@selectBalance');
Route::get('/records/search/{search}', 'RecordController@searchResults');
Route::get('/records/search/balance/{search}', 'RecordController@searchBalance');

Route::any('/records/balance', 'RecordController@balance');


