<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::group(['namespace' => 'Api'], function () {


    Route::group(['namespace' => 'Client', 'prefix' => 'client'], function () {

        // Auth Controller

        Route::post('register', 'AuthController@register');
        Route::post('login', 'AuthController@login');
        Route::post('reset-password', 'AuthController@resetPassword');
        Route::post('new-password', 'AuthController@newPassword');

        Route::middleware('auth:api')->group(function () {

            // Main Controller

            Route::get('wallet', 'MainController@wallet');
            Route::post('wallet/create', 'MainController@walletCreate');
            Route::post('password/update', 'MainController@passwordUpdate');
            Route::post('profile/update', 'MainController@profileUpdate');
            Route::post('like', 'MainController@like');

            Route::post('create-token', 'MainController@createToken');
            Route::post('remove-token', 'MainController@removeToken');

            // Order Controller

            Route::get('new-order', 'OrderController@newOrder');
            Route::get('current-order', 'OrderController@CurrentOrder');
            Route::get('old-order', 'OrderController@OldOrder');

        });
    });

    Route::group(['namespace' => 'General', 'prefix' => 'general'], function () {

        // General Controller

        Route::get('category', 'GeneralController@category');
        Route::get('settings', 'GeneralController@settings');

    });

    Route::group(['namespace' => 'Seller', 'prefix' => 'seller'], function () {

        // Auth Controller

        Route::post('login', 'AuthController@login');
        Route::post('register', 'AuthController@register');
        Route::post('reset-password', 'AuthController@resetPassword');
        Route::post('new-password', 'AuthController@newPassword');

        Route::middleware('auth:seller')->group(function () {

            // Main Controller

            Route::get('wallet', 'MainController@wallet');
            Route::post('wallet/create', 'MainController@walletCreate');
            Route::post('password/update', 'MainController@passwordUpdate');
            Route::post('profile/update', 'MainController@profileUpdate');

            Route::post('create-token', 'MainController@createToken');
            Route::post('remove-token', 'MainController@removeToken');

            Route::get('products', 'MainController@products');
            Route::get('show-product', 'MainController@showProduct');
            Route::post('create-product', 'MainController@createProduct');
            Route::post('update-product', 'MainController@updateProduct');
            Route::post('remove-product', 'MainController@removeProduct');

            // Order Controller

            Route::get('new-order', 'OrderController@newOrder');
            Route::get('current-order', 'OrderController@CurrentOrder');
            Route::get('old-order', 'OrderController@OldOrder');


        });
    });

});
