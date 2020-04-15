<?php

Route::group(['prefix'=>'admin'], function (){

	Route::get('/login', '\App\Admin\Controllers\LoginController@index');

	Route::post('/login', '\App\Admin\controllers\LoginController@login');

	Route::group(['middleware' => 'auth:admin'], function (){

		Route::get('/', '\App\Admin\Controllers\HomeController@index');

		Route::get('/logout', '\App\Admin\Controllers\LoginController@logout');

		Route::get('/home', '\App\Admin\Controllers\HomeController@index');

		Route::group(['middleware'=>'can:system'], function (){
			//后台用户管理模块

			Route::get('/users', '\App\Admin\Controllers\UserController@index');

			Route::get('/users/create', '\App\Admin\Controllers\UserController@create');

			Route::post('/users', '\App\Admin\Controllers\UserController@store');

			Route::get('/users/{user}/role', '\App\Admin\Controllers\UserController@role');

			Route::post('/users/{user}/role', '\App\Admin\Controllers\UserController@updateRole');

			//角色管理模块
			Route::get('/roles', '\App\Admin\Controllers\RoleController@index');

			Route::get('/roles/create', '\App\Admin\Controllers\RoleController@create');

			Route::post('/roles/store', '\App\Admin\Controllers\RoleController@store');

			Route::get('/roles/{role}/permission', '\App\Admin\Controllers\RoleController@permission');

			Route::post('/roles/{role}/permission', '\App\Admin\Controllers\RoleController@updatePermission');

			//权限管理模块
			Route::get('/permissions', '\App\Admin\Controllers\PermissionController@index');

			Route::get('/permissions/create', '\App\Admin\Controllers\PermissionController@create');

			Route::post('/permissions/store', '\App\Admin\Controllers\PermissionController@store');
		});

		Route::group(['middleware'=>'can:article'], function (){
			//文章审核模块

			Route::get('/articles', '\App\Admin\Controllers\ArticleController@index');

			Route::post('/articles/{article}', '\App\Admin\Controllers\ArticleController@status');
		});

		Route::group(['middleware'=>'can:topic'], function (){
			//专题管理模块

			Route::get('/topics', '\App\Admin\Controllers\TopicController@index');

			Route::get('/topics/create', '\App\Admin\Controllers\TopicController@create');

			Route::post('/topics/store', '\App\Admin\Controllers\TopicController@store');

			Route::post('/topics/{topic}', '\App\Admin\Controllers\TopicController@delete');
		});

		Route::group(['middleware'=>'can:notice'], function (){
			//消息管理模块

			Route::get('/notices', '\App\Admin\Controllers\NoticeController@index');

			Route::get('/notices/create', '\App\Admin\Controllers\NoticeController@create');

			Route::post('/notices', '\App\Admin\Controllers\NoticeController@store');

			Route::get('/notices/{notice}/send', '\App\Admin\Controllers\NoticeController@send');

			Route::get('/notices/{notice}/delete', '\App\Admin\Controllers\NoticeController@delete');
		});

	});
});
