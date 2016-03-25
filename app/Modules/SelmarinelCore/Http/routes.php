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

Route::group(['prefix' => 'SelmarinelCore'], function() {
	Route::get('/', function() {
		dd('This is the SelmarinelCore module index page.');
	});
});

Route::get('/', ['as' => 'site:index', 'uses' => 'SiteController@index']);
Route::get('/all',['as' => 'site:all', 'uses' => 'SiteController@all']);
Route::group(['prefix' => 'site'], function() {
	$asPrefix = 'site';
	Route::group(['prefix' => 'api'], function() use ($asPrefix) {
		$asAction = ':api';
		Route::post('/admin-send', ['as' => $asPrefix . $asAction . ':admin:send', 'uses' => 'APIController@adminSend']);
		Route::get('/increment/{id}', ['as' => $asPrefix . $asAction . ':increment', 'uses' => 'APIController@increment']);
		Route::any('/order', ['as' => $asPrefix . $asAction . ':order', 'uses' => 'APIController@sendOrder']);
		Route::any('/comments/{id}', ['as' => $asPrefix . $asAction . ':comments', 'uses' => 'APIController@addComment']);
		Route::get('/v_auth', ['as' => $asPrefix . $asAction . ':auth', 'uses' => 'SiteController@redirectToProvider']);
		Route::get('/vk_auth', ['as' => $asPrefix . $asAction . ':vk_auth', 'uses' => 'SiteController@handleProviderCallback']);
		Route::get('/vk_logout', ['as' => $asPrefix . $asAction . ':vk_logout', 'uses' => 'SiteController@handleProviderCallback']);
	});
});