<?php

Route::group(['middleware' => 'web','namespace' => 'Modules\Core\Http\Controllers'], function()
{
    Route::auth();

	Route::any('/register','Front\FrontController@index');
	Route::post('bp-admin/login','BpAdmin\Main@login_admin_post');
	Route::get('bp-admin/login', function(){
	  return view('auth/login');
	});

	Route::group(['prefix' => 'bp-admin','namespace'  =>  'BpAdmin', 'middleware' => 'admin'], function () {

	Route::get('/', 'BackendController@index');
	Route::get('/dashboard', 'BackendController@index');      
	Route::get('logout','Main@logout');

	Route::get('/post/search', 'PageController@search');
	Route::resource('post', 'PostController');
	Route::post('/post/upload', 'PostController@imageUpload');

	Route::get('/page/search', 'PageController@search');
	Route::resource('page', 'PageController');

	Route::resource('user', 'UserController');
	Route::get('user/delete/{id}', 'UserController@destroy');

	Route::resource('media', 'MediaController');
	Route::post('/media/upload', 'MediaController@imageUpload');

	Route::resource('slider', 'SliderController');
	Route::post('/slider/upload', 'SliderController@imageUpload');

	Route::resource('menu', 'MenuController');
	Route::get('menu/delete/{id}','MenuController@destroy');
	Route::post('menu/pagestore', 'MenuController@pageStore');
	Route::post('menu/poststore', 'MenuController@postStore');

	Route::get('/category/search', 'CategoryController@search');
	Route::resource('category', 'CategoryController');

	Route::get('/taxonomy/search', 'TaxController@search');
	Route::resource('taxonomy', 'TaxController');      

	Route::get('generals','SettingsController@index');
	Route::get('generals/add', 'SettingsController@generaledit');
	Route::post('generals/add', 'SettingsController@generaledit');


	Route::resource('account', 'AccountController');
	Route::get('account/delete/{id}', 'AccountController@destroy');
	Route::resource('custom', 'CustomController');

	});

	Route::get('/', 'Front\FrontController@index');
	Route::get('/{name}', 'Front\FrontController@menu');
	Route::get('/cat/{name}', 'Front\FrontController@cat');

	Route::get('/test', function(){
	 return abort(404);
	});	
});
