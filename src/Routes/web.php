<?php

// src/Routes/web.php
Route::group(['middleware' => ['web']], function () {
    Route::get('admin/albums/{id}/tracks', 'Vadiasov\TracksAdmin\Controllers\TracksController@index')->name('admin/albums/{id}/tracks');
    Route::get('admin/albums/{id}/tracks/create', 'Vadiasov\TracksAdmin\Controllers\TracksController@create')->name('admin/albums/{id}/tracks/create');
    Route::post('admin/albums/{id}/tracks/create', 'Vadiasov\TracksAdmin\Controllers\TracksController@store');
    Route::get('admin/albums/{id}/tracks/{trackId}/edit', 'Vadiasov\TracksAdmin\Controllers\TracksController@edit')->name('admin/albums/{id}/tracks/edit');
    Route::post('admin/albums/{id}/tracks/{trackId}/edit', 'Vadiasov\TracksAdmin\Controllers\TracksController@update');
    Route::get('admin/albums/{id}/tracks/{trackId}/delete', 'Vadiasov\TracksAdmin\Controllers\TracksController@destroy');
    Route::get('admin/albums/{id}/tracks/{trackId}/upload', 'Vadiasov\TracksAdmin\Controllers\TracksController@upload');
    Route::post('admin/albums/{id}/tracks/{trackId}/file-delete', 'Vadiasov\TracksAdmin\Controllers\TracksController@fileDelete');
});
