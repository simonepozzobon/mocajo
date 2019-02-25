<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/cookies/accepted', 'MainController@cookies_preferences');

Route::prefix('admin')->group(function() {
    Route::prefix('homepage')->group(function() {
        Route::post('/upload-video', 'AdminController@homepage_post_video');
        Route::get('/get-video', 'AdminController@homepage_get_video');
    });
});
