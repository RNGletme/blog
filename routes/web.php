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

Route::get('/', 'ArticleController@index');

Route::get('/article', 'ArticleController@index');

Route::middleware('auth')->group(function (){

	Route::get('/article/{article}/edit', 'ArticleController@edit');

	Route::post('/article', 'ArticleController@store');

	Route::get('/article/create', 'ArticleController@create');

	Route::get('/article/{article}/delete', 'ArticleController@destroy');

	Route::put('/article/{article}', 'ArticleController@update');

	Route::post('/article/image/upload', 'ArticleController@imageUpload');

	Route::get('/logout', 'LoginController@logout');

	Route::get('/user/{me}', 'UserController@index');

	Route::get('/user/{me}/setting', 'UserController@setting');

	Route::post('/user/{me}/setting', 'UserController@settingStore');

	Route::post('/article/{article}/comment', 'ArticleController@comment');

	Route::get('/article/{article}/like', 'ArticleController@like');

	Route::get('/article/{article}/unlike', 'ArticleController@unlike');

	Route::post('/user/{user}/fan', 'UserController@fan');

	Route::post('/user/{user}/unfan', 'UserController@unFan');

	Route::post('/topic/{topic}/submit', 'TopicController@submit');

	Route::get('/notices', 'NoticeController@index');
});

Route::get('/article/{article}', 'ArticleController@show');

Route::post('article/search', 'ArticleController@search');

Route::get('/login', 'LoginController@index')->name('login');

Route::post('/login', 'LoginController@login');

Route::get('/register', 'RegisterController@index');

Route::post('/register', 'RegisterController@register');

Route::get('/topic/{topic}', 'TopicController@show');


include_once('admin.php');