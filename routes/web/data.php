<?php

use Illuminate\Support\Facades\Route;

/**
 * prefix: data
 * namespace: Data
 */

// Route::prefix('users')->namespace('Users')->group(function () {
//     Route::get('/', 'UserController@index');
// });

Route::group(["prefix" => "users", "namespace" => "Users"], function () {
    Route::get('/', 'UserController@index');
    Route::post('/', 'UserController@store');
    Route::delete('/{user}', 'UserController@destroy');
});
