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

Route::group(['prefix' => 'selmarinel_gallery'], function() {
	Route::get('/', function() {
		dd('This is the SelmarinelGallery module index page.');
	});
});

Route::group(['prefix' => 'api'], function() {
	$asPrefix = 'api';
	Route::group(['prefix' => 'gallery'], function() use ($asPrefix) {
		$asAction = ':gallery';
		Route::any('/add', ['as' => $asPrefix . $asAction . ':add', 'uses' => 'GalleryController@addPhoto']);
		Route::delete('/del/{id}', ['as' => $asPrefix . $asAction . ':del', 'uses' => 'GalleryController@delPhoto']);
	});
});
