<?php

use Illuminate\Support\Facades\Route;
use Melipayamak\MelipayamakApi;

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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/bio', 'HomeController@bio')->name('bio');
Route::get('/AboutUs/', 'HomeController@about')->name('about');
Auth::routes(['verify' => true]);
Route::get('/auth/google', 'Auth\GoogleController@redirect')->name('auth.google');
Route::get('/auth/google/callback', 'Auth\GoogleController@callback');
Route::get('/user/resetpassword', 'Auth\ResetPasswordController@reset_view')->name('user.resetpassword');
Route::post('/user/resetpassword', 'Auth\ResetPasswordController@reset_post');
Route::get('/user/confirm', 'Auth\ResetPasswordController@confirm')->name('user.confirmpass');
Route::post('/user/confirm', 'Auth\ResetPasswordController@confirm_post');
Route::get('/user/reset', 'Auth\ResetPasswordController@reset')->name('user.reset');
Route::post('/user/reset', 'Auth\ResetPasswordController@resetpass_post');
Route::post('/logout', 'HomeController@logout')->name('logout');
Route::get('/contact-us', 'ContactController@show')->name('contact.show');
Route::post('/contact-us', 'ContactController@send')->name('contact.send');

Route::middleware('auth')->prefix('profile')->namespace('User')->group(function () {
    Route::get('/', 'UserController@index')->name('profile');
    Route::post('/user/update/{id}', 'UserController@update')->name('user.update');
    Route::get('/user/valid-code', 'UserController@valid')->name('user.valid');
    Route::post('/user/valid-code', 'UserController@valid_code')->name('user.valid.code');
    Route::post('/favourit/{id}', 'FavouriteController@store');
    Route::post('/order/', 'OrderController@store')->middleware(['check.cart'])->name('order.store');

});
Route::post('/check_discount/{discount}', 'User\OrderController@check_discount');
Route::get('/user/phone', 'User\UserController@phone')->name('user.phone');
Route::post('/user/phone', 'User\UserController@valid_phone');

Route::get('/search/', 'SearchController@index')->name('store');
Route::get('/products/{slug}', 'ProductController@single')->name('single');
Route::post('/comment', 'CommentController@store')->name('comment');

Route::middleware(['auth' , 'check.cart'])->namespace('User')->group(function () {
    Route::POST('cart/add/{id}', 'CartController@addtocart')->name('add.cart');
    Route::get('cart', 'CartController@cart')->name('cart');
    Route::patch('cart/quantity/change', 'CartController@cartchange');
    Route::delete('cart/remove/{id}', 'CartController@remove')->name('cartdelete');
});

Route::get('/articles', 'ArticleController@articles')->name('articles');
Route::get('/article/{slug}', 'ArticleController@single')->name('single.article');

Route::get('/team-us', 'HomeController@team')->name('team');


Route::get('/Companyes', 'CompanyController@index')->name('companys');
Route::get('/Companyes/{id}', 'CompanyController@single')->name('single.company');

