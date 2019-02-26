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
        Route::post('/upload-video', 'Admin\HomePageController@post_video');
        Route::get('/get-video', 'Admin\HomePageController@get_video');
    });

    Route::prefix('scuolamocajo')->group(function() {
        Route::get('/get-options', 'Admin\ScuolaMocajoController@get_options');
        Route::post('/save-section', 'Admin\ScuolaMocajoController@save_section');
    });

    Route::prefix('storia')->group(function() {
        Route::get('/get-options', 'Admin\StoriaController@get_options');
        Route::post('/save-section', 'Admin\StoriaController@save_section');
    });

    Route::prefix('contact')->group(function() {
        Route::get('/get-options', 'Admin\ContactController@get_options');
        Route::post('/save-section', 'Admin\ContactController@save_section');
    });

    Route::prefix('products')->group(function() {
        Route::get('/get-products', 'Admin\ProductController@get_products');
        Route::post('/save-product', 'Admin\ProductController@save_product');
        Route::post('/destroy', 'Admin\ProductController@destroy');
    });

    Route::prefix('shops')->group(function() {
        Route::get('/get-shops', 'Admin\ShopController@get_shops');
        Route::get('/get-cities', 'Admin\ShopController@get_cities');
        Route::post('/save-shop', 'Admin\ShopController@save_shop');
        Route::post('/save-city', 'Admin\ShopController@save_city');
        Route::post('/destroy', 'Admin\ShopController@destroy');
        Route::post('/city-destroy', 'Admin\ShopController@city_destroy');
    });

    Route::prefix('settings')->group(function() {
        Route::get('/get-options', 'Admin\SettingController@get_options');
        Route::post('/save-section', 'Admin\SettingController@save_section');
    });
});
