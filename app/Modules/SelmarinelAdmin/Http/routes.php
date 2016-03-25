<?php

/*
|--------------------------------------------------------------------------
| Module Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for the module.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(['prefix' => 'selmarinel_admin'], function() {
	Route::get('/', function() {
		dd('This is the SelmarinelAdmin module index page.');
	});
});

Route::group(['middleware' => 'web'], function () {
	Route::auth();
	Route::any('/register',function(){
			return view('errors.403');
	});
	$asPrefix = 'admin';
	Route::group(['prefix' => 'admin'], function() use ($asPrefix) {
		Route::get('/', ['as' => $asPrefix .':index', 'uses' => 'AdminController@index']);
		Route::group(['prefix' => 'projects'], function() use ($asPrefix) {
			$asAction = ':projects';
			Route::get('/', ['as' => $asPrefix . $asAction . ':index', 'uses' => 'ProjectsController@index']);
			Route::get('/{id}/active', ['as' => $asPrefix . $asAction. ':active', 'uses' => 'ProjectsController@active']);
			Route::any('/add', ['as' => $asPrefix . $asAction.':add', 'uses' => 'ProjectsController@add']);
			Route::any('/{id}/edit', ['as' => $asPrefix . $asAction.':edit', 'uses' => 'ProjectsController@edit']);
		});
		Route::group(['prefix' => 'orders'], function() use ($asPrefix) {
			$asAction = ':orders';
			Route::get('/', ['as' => $asPrefix . $asAction . ':index', 'uses' => 'OrdersController@index']);
			Route::get('/{id}/active', ['as' => $asPrefix . $asAction. ':active', 'uses' => 'OrdersController@active']);
			Route::get('/{id}/decline', ['as' => $asPrefix . $asAction. ':decline', 'uses' => 'OrdersController@decline']);
		});
		Route::group(['prefix' => 'comments'], function() use ($asPrefix) {
			$asAction = ':comments';
			Route::get('/', ['as' => $asPrefix . $asAction . ':index', 'uses' => 'CommentsController@index']);
			Route::get('/{id}/active', ['as' => $asPrefix . $asAction. ':active', 'uses' => 'CommentsController@active']);
			Route::any('/{id}/edit', ['as' => $asPrefix . $asAction.':edit', 'uses' => 'CommentsController@edit']);
		});
		Route::group(['prefix' => 'files'], function() use ($asPrefix) {
			$asAction = ':files';
			Route::get('/', ['as' => $asPrefix . $asAction . ':index', 'uses' => 'FilesController@index']);
			Route::get('/{id}/active', ['as' => $asPrefix . $asAction. ':active', 'uses' => 'FilesController@active']);
			Route::any('/{id}/edit', ['as' => $asPrefix . $asAction.':edit', 'uses' => 'FilesController@edit']);
		});
	});
});