<?php

Route::auth();
Route::group(['middleware' => 'web'], function() {
	
	Route::get('reset-password', 	'Auth\AuthController@reset_password');
	Route::post('reset', 			'Auth\AuthController@reset');
	Route::get('new-password/{token}', 		'Auth\AuthController@new_password');
	Route::post('save_password', 		'Auth\AuthController@save_password');

});

Route::group(['middleware' => 'auth'], function() {
	Route::get('/', 'HomeController@index');
	Route::group(['middleware' => ['role:admin']], function() {
		Route::post('/users/datatable'	, 'UserController@datatable');
		Route::resource('/users'		, 'UserController', ['except' => ['show']]);
		Route::resource('/clients'		, 'ClientController', ['except' => ['show']]);
		Route::post('/clients/datatable'	, 'ClientController@datatable');
		Route::resource('/products'		, 'ProductsController', ['except' => ['show']]);
		Route::post('/products/datatable'	, 'ProductsController@datatable');
	});
	Route::group(['middleware' => ['role:manager']], function() {
	
		Route::resource('/products'		, 'ProductsController', ['except' => ['show']]);
		Route::post('/products/datatable'	, 'ProductsController@datatable');
	});
	Route::group(['middleware' => ['role:client_manager']], function() {
		
		Route::resource('/clients'		, 'ClientController', ['except' => ['show']]);
		Route::post('/clients/datatable'	, 'ClientController@datatable');
		
	});

});
