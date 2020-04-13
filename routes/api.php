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

        Route::post('register', 'AuthController@register');
        Route::post('login', 'AuthController@login');
        Route::post('reset-password', 'AuthController@resetPassword');
        Route::post('new-password', 'AuthController@newPassword');

        Route::middleware('auth:api')->group(function () {

            Route::get('wallet', 'MainController@wallet');
            Route::post('wallet/create', 'MainController@walletCreate');

        });
    });

    Route::group(['namespace' => 'General', 'prefix' => 'general'], function () {

            Route::get('category', 'GeneralController@category');

    });

    Route::group(['namespace' => 'Seller', 'prefix' => 'seller'], function () {

        Route::post('login', 'AuthController@login');
        Route::post('register', 'AuthController@register');
        Route::post('reset-password', 'AuthController@resetPassword');
        Route::post('new-password', 'AuthController@newPassword');

        Route::middleware('auth:seller')->group(function () {

            Route::get('wallet', 'MainController@wallet');
            Route::post('wallet/create', 'MainController@walletCreate');

        });
    });

});
