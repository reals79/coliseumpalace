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

Auth::routes();

Route::group(['prefix' => LaravelLocalization::setLocale()], function() {
	$domain = (App::environment('local')) ? 'coliseumpalace.dev' : 'coliseumpalace.md';
	Route::domain("{my}.$domain")->group(function() {
	    Route::get('/', 'AccountController@index')->name('account');
	});

	Route::group(['domain' => $domain], function() {
		Route::get('/', 'AppController@index')->name('home');
		Route::get('content/{content}', 'AppController@content')->name('content');
		Route::get('apartment/{apartmentType}/{apartment?}', 'AppController@apartment')->name('apartment');
		Route::get('gallery/{gallery?}', 'AppController@gallery')->name('gallery');
		Route::get('video/', 'AppController@video')->name('video');
	});

});

Route::get('get-settings', 'AppController@getSettings');
