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

Route::group([
		'prefix' => LaravelLocalization::setLocale(),
		'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function() {
	Auth::routes();
	$domain = str_replace('my.', '', request()->getHost());
	Route::domain("{my}.$domain")->group(function() {
	    Route::get('/', 'AccountController@index')->name('account');
	});
	Route::group(['domain' => $domain], function() {
		Route::get('/', 'AppController@index')->name('home');
		Route::get('content/{content}', 'AppController@content')->name('content');
		Route::get('about', 'AppController@about')->name('about');
		Route::get('apartment/{apartmentType}/{building_id?}/{apartment?}', 'AppController@apartment')->name('apartment');
		Route::get('commercial/{building_id?}/{commercial_area?}', 'AppController@commercial')->name('commercial');
		Route::get('gallery/{gallery?}', 'AppController@gallery')->name('gallery');
		Route::get('video/', 'AppController@video')->name('video');
	});

});

Route::get('get-settings', 'AppController@getSettings');
