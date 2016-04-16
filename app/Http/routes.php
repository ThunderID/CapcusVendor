<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

View::composer('*', function($view){
	View::share('view_name', $view->getName());
});

Route::group([], function () {

	Route::get('/', 						['as' => 'login'		, 'uses' => 'LoginController@form']);
	Route::post('/', 						['as' => 'login.post'	, 'uses' => 'LoginController@post_login']);
	Route::get('/logout', 					['as' => 'logout'		, 'uses' => 'LoginController@logout']);
	

	Route::group(['prefix' => 'dashboard'], function() {
		Route::get('/', 									['as' => 'dashboard'		, 'uses' => 'DashboardController@overview']);

		Route::group(['prefix' => 'voucher', 'as' => 'voucher.'], function(){
			Route::get('/', 					['as' => 'index', 		'uses' => 'VoucherController@index']);
			Route::get('/detail/{code}', 		['as' => 'detail', 		'uses' => 'VoucherController@detail']);
			Route::post('/', 					['as' => 'validate', 	'uses' => 'VoucherController@validate']);
		});
	});
});
