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

Route::get('/panel', 'HomeController@index')->name('panel');


Route::resource('user' , 'UserController')->except('show');
Route::get('permission/user/{id}' , 'PermissionUserController@create')->name('user.permission');
Route::post('permission/user/{id}' , 'PermissionUserController@store');

Route::resource('permission' , 'PermissionController')->except('show');
Route::resource('Role' , 'RoleController')->except('show');

Route::resource('category' , 'CategoryController')->except('show');
Route::put('category/delete/{id}' , 'CategoryController@restor')->name('category.restor');

Route::resource('product' , 'ProductController');
Route::resource('product/{product}/gallery' , 'ProductGalleryController');
Route::post('attribute/values' , 'AttributeController@getValues');
Route::post('attribute/delete' , 'AttributeController@delete');


Route::get('/comments' , 'CommentController@index')->name('comments');
Route::put('/comments/approved/{id}' , 'CommentController@approve')->name('comments.approve');
Route::post('/comments/send' , 'CommentController@send')->name('comments.send');
Route::delete('/comments/{id}/delete' , 'CommentController@delete')->name('comments.delete');

Route::resource('categoryA' , 'CategoryArticleController')->except('show');
Route::put('categorya/delete/{id}' , 'CategoryArticleController@restor')->name('categorya.restor');
Route::resource('article' , 'ArticleController')->except('show');

Route::get('contact' , 'ContactController@index')->name('contact.index');
Route::delete('Contact/{id}/delete' , 'ContactController@delete')->name('contact.delete');
Route::post('contact/{id}' , 'ContactController@approved')->name('contact.approved');
Route::get('/contact/{id}/send' , 'ContactController@send')->name('contact.send');
Route::post('/contact/{id}/send' , 'ContactController@send_email')->name('contact_send_email');


Route::resource('discount' , 'DiscountController')->except('show');
Route::resource('orders' , 'OrderController');
Route::put('/order/cancel/{id}' , 'OrderController@cancel')->name('order.cancel');


Route::get('/option' , 'OptionController@index')->name('option.index');
Route::post('/option' , 'OptionController@update');


Route::resource('partners' , 'PartnerController')->except('show');

Route::resource('companys' , 'CompanyController')->except('show');


Route::resource('slider' , 'SliderController')->except('show');


Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


