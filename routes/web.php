<?php

use Illuminate\Support\Facades\Route;

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
Route::group(['namespace'=>'Guest', 'as'=>'guest.'], function () {
    Route::get('/', 'PageController@index')->name('index');
    Route::get('/product/{id}', 'PageController@product')->name('product');
    Route::get('/category/{slug}', 'CategoryController@index')->name('category');
    Route::get('/search', 'SearchController@index')->name('search');
    Route::group([
        'prefix' => 'feedback',
        'as' => 'feedback.'
    ], function () {
        Route::get('/', 'PageController@feedbackCreate')->name('create');
        Route::post('/', 'PageController@feedbackStore')->name('store');
    });
});

Route::group(['prefix'=>'cart', 'as'=>'cart.'], function () {
    Route::get('/', 'CartController@index')->name('index');
    Route::post('/add', 'CartController@add')->name('add');
    Route::post('/remove/{rowId}', 'CartController@remove')->name('remove');
});

Auth::routes(['verify' => true]);

Route::group([
    'prefix'=>'email',
    'as'=>'email.',
    'namespace'=>'Auth',
    'middleware'=>['web']
], function () {
    Route::post('/email', [
        'middleware'=>['auth', 'verified'],
        'uses'=>'ResetEmailController@sendResetLinkEmail'
    ])->name('email');
    Route::get('/reset/{token}', 'ResetEmailController@reset')->name('reset');
});

Route::group([
    'prefix'=> 'customer',
    'as'=> 'customer.',
    'namespace'=> 'Customer',
    'middleware'=> ['web', 'auth', 'verified', 'customer']
], function () {
//    Route::get('/', 'CustomerController@index')->name('index');
    Route::group([
        'prefix'=> 'favorite',
        'as'=> 'favorite.'
    ], function () {
        Route::get('/', 'FavoriteController@index')->name('index');
        Route::post('/{id}', 'FavoriteController@toggle')->name('toggle');
    });
    Route::group([
        'prefix'=> 'profile',
        'as'=> 'profile.'
    ], function () {
        Route::get('/', 'ProfileController@index')->name('index');
        Route::post('/', 'ProfileController@update')->name('update');
        Route::post('/password', 'ProfileController@passwordUpdate')->name('password.update');
    });

    Route::group(['as'=>'checkout.'], function () {
        Route::get('/checkout', 'CheckoutController@index')->name('index');
        Route::post('/checkout', 'CheckoutController@store')->name('store');
    });

    Route::group([
        'prefix' => 'order',
        'as' => 'order.'
    ], function () {
        Route::get('/', 'OrderController@index')->name('index');
        Route::get('/{id}', 'OrderController@show')->name('show');

    });
});

Route::group([
    'prefix'=>'admin',
    'as'=>'admin.',
    'namespace'=>'Admin',
    'middleware'=>['web', 'auth', 'verified', 'admin']
], function () {
    Route::get('/', 'AdminController@index')->name('index');
    Route::post('/product/upload-image', 'ProductController@upload_image')->name('product.upload_image');
    Route::resource('/product', 'ProductController')->except('show');
    Route::resource('/order', 'OrderController');
    Route::group(['prefix' => 'delivery', 'as' => 'delivery.'], function () {
        Route::get('/', 'DeliveryController@index')->name('index');
        Route::get('/product/{id}', 'DeliveryController@product')->name('product');
        Route::get('/products', 'DeliveryController@products')->name('products');
    });
    Route::resource('feedback', 'FeedbackController', ['except'=>['create', 'store']]);
    Route::resource('categories', 'CategoryController', ['except'=>['show']]);
});

