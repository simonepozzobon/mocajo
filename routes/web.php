<?php

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

Route::get('/login', 'LoginController@login');
Route::post('/login-attempt', 'LoginController@attempt_login')->name('login.attempt');

Route::prefix('admin')->group(function() {
    Route::get('/', 'AdminController@index');
    Route::get('/{slug}', 'AdminController@index')->where('slug', '.*');
});

Route::get('/{slug}', 'MainController@index')->where('slug', '.*');
