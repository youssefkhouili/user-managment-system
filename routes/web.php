<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('users')->namespace('Users')->middleware('auth')->name('users.')->group(function () {
    Route::get('/', 'UserController@index')->name('dashboard');
});

// Route::group(["namespace" => "Users", "middleware" => "auth", "prefix" => "users", "as" => "users."], function () {
//     Route::get('/', 'UserController@index')->name('dashboard');
// });
Route::prefix('data')->namespace('Data')->middleware('auth')->group(base_path('routes/web/data.php'));
