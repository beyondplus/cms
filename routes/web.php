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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/home', function() {
// 	echo "dsaf";
// });
Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('lang/{locale}', function ($locale) {
	if($locale == "mm"){
		Session::put('applocale', 'mm');
		App::setLocale($locale);
	} else {
		Session::put('applocale', 'en');
		App::setLocale("en");
	}    
	$locale = App::getLocale();
	return redirect()->back();
});
