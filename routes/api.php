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
Route::post('/verify', 'CaptchaController@verify');

Route::post('/pay', 'CheckoutController@pay');
Route::post('/save-order', 'CheckoutController@new_order');

Route::prefix('admin')->group(function() {
    Route::prefix('homepage')->group(function() {
        Route::post('/upload-video', 'Admin\HomePageController@post_video');
        Route::get('/get-video', 'Admin\HomePageController@get_video');
    });

    Route::prefix('scuolamocajo')->group(function() {
        Route::get('/get-options', 'Admin\ScuolaMocajoController@get_options');
        Route::post('/save-section', 'Admin\ScuolaMocajoController@save_section');
    });

    Route::prefix('vini')->group(function() {
        Route::get('/get-options', 'Admin\ViniController@get_options');
        Route::post('/save-section', 'Admin\ViniController@save_section');
    });

    Route::prefix('storia')->group(function() {
        Route::get('/get-options', 'Admin\StoriaController@get_options');
        Route::post('/save-section', 'Admin\StoriaController@save_section');
    });

    Route::prefix('contact')->group(function() {
        Route::get('/get-options', 'Admin\ContactController@get_options');
        Route::post('/save-section', 'Admin\ContactController@save_section');
    });

    Route::prefix('privacy')->group(function() {
        Route::get('/get-options', 'Admin\PrivacyController@get_options');
        Route::post('/save-section', 'Admin\PrivacyController@save_section');
    });

    Route::prefix('error')->group(function() {
        Route::get('/get-options', 'Admin\ErrorController@get_options');
        Route::post('/save-section', 'Admin\ErrorController@save_section');
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

    Route::prefix('orders')->group(function() {
        Route::get('/get-order/{id}', 'Admin\OrderController@get_order');
        Route::get('/get-orders', 'Admin\OrderController@get_orders');
        Route::get('/set-shipped/{id}', 'Admin\OrderController@set_shipped');
        Route::get('/set-delivered/{id}', 'Admin\OrderController@set_delivered');
    });

    Route::prefix('shippings')->group(function() {
        Route::get('/get-shippings', 'Admin\ShippingController@get_shippings');
        Route::post('/save-shipping', 'Admin\ShippingController@save_shipping');
        Route::post('/destroy', 'Admin\ShippingController@destroy');
    });

    Route::prefix('settings')->group(function() {
        Route::get('/get-options', 'Admin\SettingController@get_options');
        Route::post('/save-section', 'Admin\SettingController@save_section');
    });

    Route::prefix('seo')->group(function() {
        Route::get('/page/{id}', 'Admin\SeoController@get_page_seo');
        Route::post('/save', 'Admin\SeoController@save_seo');
    });

});
