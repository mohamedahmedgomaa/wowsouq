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

Route::group(['prefix' => 'admin'], function () {

    Auth::routes(['register' => false]);

    Route::group(['middleware' => ['auth', 'auto-check-permission']], function () {

        Route::group(['namespace' => 'Admin'], function () {

            Route::get('/', 'GeneralController@dashboard')->name('dashboard');

            Route::resource('admin', 'AdminController');
            Route::delete('admin/destroy/all', 'AdminController@multi_delete');
            Route::post('/change-password', 'AdminController@changePassword')->name('changePassword');
            Route::get('/get-change-password', 'AdminController@getChangePassword')->name('getChangePassword');

            Route::resource('permission', 'PermissionController');
            Route::delete('permission/destroy/all', 'PermissionController@multi_delete');

            Route::resource('role', 'RoleController');
            Route::delete('role/destroy/all', 'RoleController@multi_delete');

            Route::resource('client', 'ClientController');
            Route::delete('client/destroy/all', 'ClientController@multi_delete');
            Route::post('/client/wallet/{id}', 'ClientController@wallet')->name('clients.wallet');
            Route::get('/clients/trashed', 'ClientController@trashed')->name('clients.trashed'); // Route Soft Deleted
            Route::post('/clients/soft-delete/{id}', 'ClientController@softDelete')->name('clients.soft.delete');
            Route::get('/clients/restore/{id}', 'ClientController@restore')->name('clients.restore');


            Route::resource('seller', 'SellerController');
            Route::delete('seller/destroy/all', 'SellerController@multi_delete');
            Route::get('/seller/activated/{id}', 'SellerController@activated')->name('sellers.activated');
            Route::get('/seller/not-activated/{id}', 'SellerController@notActivated')->name('sellers.notActivated');
            Route::get('/seller/forbidden/{id}', 'SellerController@forbidden')->name('sellers.forbidden');
            Route::post('/seller/wallet/{id}', 'SellerController@wallet')->name('sellers.wallet');
            Route::get('/sellers/trashed', 'SellerController@trashed')->name('sellers.trashed'); // Route Soft Deleted
            Route::post('/sellers/soft-delete/{id}', 'SellerController@softDelete')->name('sellers.soft.delete');
            Route::get('/sellers/restore/{id}', 'SellerController@restore')->name('sellers.restore');


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

    Route::get('lang/{lang}', function ($lang) {
        session()->has('lang') ? session()->forget('lang') : '';
        $lang == 'ar' ? session()->put('lang', 'ar') : session()->put('lang', 'en');
        return back();
    });
});

// Route Web Site Wow SouQ

Route::group(['namespace' => 'WowSouq'], function () {

    Route::get('/', 'GeneralController@wow_souq')->name('index');
    Route::get('/contact', 'GeneralController@contact')->name('contact');
    Route::post('/contact', 'GeneralController@contacts')->name('contacts');

    // Product
    Route::get('/product/{id}', 'GeneralController@product')->name('product');

    Route::group(['namespace' => 'Client', 'prefix' => 'client'], function () {

        Route::get('/login', 'AuthController@getLogin')->name('wowsouq.client.get_login');
        Route::post('/login', 'AuthController@login')->name('wowsouq.client.login');

        Route::get('/register', 'AuthController@getRegister')->name('wowsouq.client.get_register');
        Route::post('/register', 'AuthController@register')->name('wowsouq.client.register');

        Route::get('/logout', 'AuthController@logout')->name('wowsouq.client.logout');
        Route::post('/logout', 'AuthController@logout')->name('wowsouq.client.logout');

        Route::get('/forget/password', 'AuthController@getForgetPassword')->name('wowsouq.client.get.forget.password');
        Route::post('/forget/password', 'AuthController@forgetPassword')->name('wowsouq.client.forget.password');
        Route::post('/reset/code', 'AuthController@forgetPassword')->name('wowsouq.client.reset.code');

        Route::get('/reset/password', 'AuthController@getResetPassword')->name('wowsouq.client.get.reset.password');
        Route::post('/reset/password', 'AuthController@resetPassword')->name('wowsouq.client.reset.password');

        Route::get('add-to-cart/{id}', 'MainController@getAddToCart')->name('client.getAddToCart');
        Route::get('shopping-cart', 'MainController@shoppingCart')->name('client.shoppingCart'); // 14
        Route::get('reduce/{id}', 'MainController@getReduceByOne')->name('client.reduceByOne');
        Route::get('remove/{id}', 'MainController@getRemoveItem')->name('client.remove');

        Route::group(['middleware' => ['auth:clients']], function () {

        });

    });


    Route::group(['namespace' => 'Seller', 'prefix' => 'seller'], function () {


        Route::group(['middleware' => ['auth:sellers']], function () {

        });

    });

});
