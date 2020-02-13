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

Auth::routes();

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/payed', 'PaymentMethodController@index');
Route::get('/payed1', 'PaymentMethodController@index1');
Route::post('/pay', 'PaymentMethodController@pay');

Route::resource('/cart', 'CartController', [
    'names' => [
        'store' => 'carts.store',
    ]
]);

Route::resource('/whishlist', 'WishlistController', [
    'names' => [
        'store' => 'whishlist.store',
    ]
]);

Route::resource('/rating', 'UpvoteController', [
    'names' => [
        'store' => 'rating.store',
    ]
]);

Route::get('/search', ['uses' =>'SearchController@getSearch', 'as'=>'search']);
Route::resource('/categories','CategoriesController');
Route::resource('/authors', 'AuthorsController');
Route::resource('/', 'WelcomeController');
Route::resource('/books', 'AudiobookController');
Route::resource('/wishlist', 'WishlistController');
Route::resource('/results', 'SearchController');
Route::resource('/boughts', 'BoughtController');
Route::resource('/collections','CollecionsController');
Route::get('/profile/{id}', 'ProfileController@show')->middleware('auth');
Route::post('/profile/{id}', 'ProfileController@update')->middleware('auth');
Route::get('/paymethods/{id}', 'PaymentMethodController@destroy')->middleware('auth');
Route::post('/paymethods', 'PaymentMethodController@store')->middleware('auth');


