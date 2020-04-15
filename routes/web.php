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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {

    Auth::routes(['register' => false]);

    Route::group(['middleware' => ['auth']], function () {

        Route::group(['namespace' => 'Admin'], function () {

            Route::get('/', 'GeneralController@dashboard')->name('dashboard');

            Route::resource('admin', 'AdminController');
            Route::delete('admin/destroy/all', 'AdminController@multi_delete');
            Route::post('/change-password', 'AdminController@changePassword')->name('changePassword');
            Route::get('/get-change-password', 'AdminController@getChangePassword')->name('getChangePassword');

            Route::resource('client', 'ClientController');
            Route::delete('client/destroy/all', 'ClientController@multi_delete');

            Route::resource('seller', 'SellerController');
            Route::delete('seller/destroy/all', 'SellerController@multi_delete');

            Route::resource('category', 'CategoryController');
            Route::delete('category/destroy/all', 'CategoryController@multi_delete');

            Route::resource('product', 'ProductController');
            Route::delete('product/destroy/all', 'ProductController@multi_delete');

            Route::resource('order', 'OrderController');
            Route::delete('order/destroy/all', 'OrderController@multi_delete');

            Route::resource('comment', 'CommentController');
            Route::delete('comment/destroy/all', 'CommentController@multi_delete');

            Route::resource('payment-method', 'PaymentMethodController');
            Route::delete('payment-method/destroy/all', 'PaymentMethodController@multi_delete');

            Route::get('/settings', 'SettingController@index')->name('settings');
            Route::post('/settings/update', 'SettingController@update')->name('settings.update');

        });
    });

    Route::get('lang/{lang}', function($lang) {
        session()->has('lang') ? session()->forget('lang') : '';
        $lang == 'ar' ? session()->put('lang', 'ar') : session()->put('lang', 'en');
        return back();
    });
});
