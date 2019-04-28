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
Route::get('/test', 'CheckoutController@pay');

Route::get('/login', 'LoginController@login')->name('user.login');
Route::post('/login-attempt', 'LoginController@attempt_login')->name('login.attempt');
Route::get('/logout', 'LoginController@logout')->name('user.logout');

Route::prefix('admin')->middleware('admin')->group(function() {
    Route::get('/{slug?}', 'AdminController@index')->where('slug', '.*')->name('admin.dashboard');
});

Route::get('/{slug?}', 'MainController@index')->where('slug', '.*');
