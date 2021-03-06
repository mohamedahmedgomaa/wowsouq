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

            Route::resource('ad', 'AdController');
            Route::delete('ad/destroy/all', 'AdController@multi_delete');

            Route::resource('review', 'ReviewController');
            Route::delete('review/destroy/all', 'ReviewController@multi_delete');

            Route::resource('contact', 'ContactController');
            Route::delete('contact/destroy/all', 'ContactController@multi_delete');

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

    Route::get('/', 'GeneralController@index')->name('index');
    Route::get('/search', 'GeneralController@search')->name('search');
    Route::get('/contact', 'GeneralController@contact')->name('contact');
    Route::post('/contact', 'GeneralController@contacts')->name('contacts');
    Route::get('/category/{id}', 'GeneralController@category')->name('category');

    // Product
    Route::get('/product/{id}', 'GeneralController@product')->name('product');
    Route::get('/products/all', 'GeneralController@productAll')->name('productAll');
    Route::get('/products/top', 'GeneralController@productTop')->name('productTop');
    Route::get('/products/offer', 'GeneralController@productOffer')->name('productOffer');

    Route::group(['namespace' => 'Client', 'prefix' => 'client'], function () {

        Route::get('/login', 'AuthController@getLogin')->name('wowsouq.client.get_login');
        Route::post('/login', 'AuthController@login')->name('wowsouq.client.login');

        Route::get('/register', 'AuthController@getRegister')->name('wowsouq.client.get_register');
        Route::post('/register', 'AuthController@register')->name('wowsouq.client.register');

        Route::get('/logout', 'AuthController@logout')->name('wowsouq.client.logout');
        Route::post('/logout', 'AuthController@logout')->name('wowsouq.client.logout');

        Route::get('/forget/password', 'AuthController@getForgetPassword')->name('wowsouq.client.get.forget.password');
        Route::post('/forget/password', 'AuthController@forgetPassword')->name('wowsouq.client.forget.password');
        Route::post('/reset/code', 'AuthController@resetCode')->name('wowsouq.client.reset.code');

        Route::get('/reset/password', 'AuthController@getResetPassword')->name('wowsouq.client.get.reset.password');
        Route::post('/reset/password', 'AuthController@resetPassword')->name('wowsouq.client.reset.password');

        Route::get('add-to-cart/{id}', 'MainController@getAddToCart')->name('client.getAddToCart');
        Route::get('shopping-cart', 'MainController@shoppingCart')->name('client.shoppingCart'); // 14
        Route::get('reduce/{id}', 'MainController@getReduceByOne')->name('client.reduceByOne');
        Route::get('remove/{id}', 'MainController@getRemoveItem')->name('client.remove');

        Route::group(['middleware' => ['auth:clients']], function () {

            Route::get('/profile', 'MainController@getProfile')->name('wowsouq.client.get.profile');
            Route::post('/profile', 'MainController@profile')->name('wowsouq.client.profile');
            Route::post('/like', 'MainController@postLikePost')->name('like');
            Route::get('/like', 'MainController@getLike')->name('wowsouq.client.get.like');
            Route::post('add-order', 'MainController@addOrder')->name('wowsouq.client.add.order');
            Route::post('comments/{id}', 'MainController@comment')->name('wowsouq.client.comments');
            Route::post('reviews/{id}', 'MainController@review')->name('wowsouq.client.reviews');
            Route::get('/my-order', 'MainController@myOrder')->name('wowsouq.seller.get.order');
            Route::delete('/order/rejected/{id}', 'MainController@orderRejected')->name('wowsouq.client.order.rejected');

        });

    });


    Route::group(['namespace' => 'Seller', 'prefix' => 'seller'], function () {

        Route::get('/login', 'AuthController@getLogin')->name('wowsouq.seller.get_login');
        Route::post('/login', 'AuthController@login')->name('wowsouq.seller.login');

        Route::get('/register', 'AuthController@getRegister')->name('wowsouq.seller.get_register');
        Route::post('/register', 'AuthController@register')->name('wowsouq.seller.register');

        Route::get('/logout', 'AuthController@logout')->name('wowsouq.seller.logout');
        Route::post('/logout', 'AuthController@logout')->name('wowsouq.seller.logout');

        Route::get('/forget/password', 'AuthController@getForgetPassword')->name('wowsouq.seller.get.forget.password');
        Route::post('/forget/password', 'AuthController@forgetPassword')->name('wowsouq.seller.forget.password');
        Route::post('/reset/code', 'AuthController@resetCode')->name('wowsouq.seller.reset.code');

        Route::get('/reset/password', 'AuthController@getResetPassword')->name('wowsouq.seller.get.reset.password');
        Route::post('/reset/password', 'AuthController@resetPassword')->name('wowsouq.seller.reset.password');

        Route::group(['middleware' => ['auth:sellers']], function () {

            Route::get('/', 'MainController@index')->name('wowsouq.seller.index');
            Route::get('/profile', 'MainController@getProfile')->name('wowsouq.seller.get.profile');
            Route::post('/profile', 'MainController@profile')->name('wowsouq.seller.profile');
            Route::get('/my-order', 'MainController@myOrder')->name('wowsouq.seller.get.order');

            Route::group(['prefix' => 'product'], function () {

                Route::get('/create', 'ProductController@create')->name('wowsouq.seller.product.create');
                Route::post('/create', 'ProductController@store')->name('wowsouq.seller.product.store');

                Route::get('/edit/{id}', 'ProductController@edit')->name('wowsouq.seller.product.edit');
                Route::post('/update/{id}', 'ProductController@update')->name('wowsouq.seller.product.update');
                Route::delete('/delete/{id}', 'ProductController@delete')->name('wowsouq.seller.product.delete');
                Route::get('/delete/{id}', 'ProductController@delete')->name('wowsouq.seller.product.delete');

            });

        });
    });
});
