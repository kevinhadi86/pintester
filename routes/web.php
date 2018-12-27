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

Route::get('/', 'PostController@index');
Route::post('/search','PostController@search');
Route::get('/followed','PostController@followed');
Route::get('/login','UserController@showLogin')->middleware(\App\Http\Middleware\LoggedinMiddleware::class);
Route::post('/login','UserController@login');
Route::get('/register','UserController@showRegister')->middleware(\App\Http\Middleware\LoggedinMiddleware::class);
Route::post('/register','UserController@register');
Route::get('/logout','UserController@logout');

//Manage Category
Route::get('/manage/category','CategoryController@index');
Route::get('/add/category','CategoryController@create');
Route::post('/add/category','CategoryController@store');
Route::get('/edit/category/{id}','CategoryController@edit');
Route::post('/edit/category/{id}','CategoryController@update');
Route::get('/delete/category/{id}','CategoryController@destroy');

//Manage User
Route::get('/manage/user','UserController@index');
Route::get('/edit/user/{id}','UserController@editUser');
Route::post('/edit/user/{id}','UserController@updateUser');
Route::get('/delete/user/{id}','UserController@destroy');

//Change Profile
Route::get('/edit/profile','UserController@edit');
Route::post('/edit/profile/{id}','UserController@update');
Route::get('/edit/profile/category','UserController@editCategory');
Route::post('/edit/profile/category/{id}','UserController@updateCategory');

//My Posts
Route::get('/mypost','PostController@mine');
Route::get('/add/post','PostController@create');
Route::post('/add/post','PostController@store');
Route::get('/post/{id}','PostController@show');
Route::get('/delete/post/{id}','PostController@destroy');
//-- Add Comment
Route::post('/add/comment/{id}','CommentController@store');

//Cart
Route::get('/cart','HeaderController@show');
Route::get('/add/cart/{post_id}','HeaderController@store');
Route::get('/add/detail/{post_id}','DetailController@store');
Route::get('/delete/detail/{id}','DetailController@destroy');
Route::get('/checkout','HeaderController@checkout');

//History
Route::get('/history','HeaderController@history');
Route::get('/history/all','HeaderController@index');
