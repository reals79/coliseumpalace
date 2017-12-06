<?php

Route::get('login', [
    'as'   => 'admin.login',
    'uses' => 'App\Http\Controllers\Auth\AdminController@getLogin',
]);

Route::post('login', [
    'as'   => 'admin.login.post',
    'uses' => 'App\Http\Controllers\Auth\AdminController@postLogin',
]);

Route::get('logout', [
    'as'   => 'admin.logout',
    'uses' => 'App\Http\Controllers\Auth\AdminController@getLogout',
]);

Route::get('', ['as' => 'admin.dashboard', function () {
	$content = '';
	return AdminSection::view($content, 'Dashboard');
}]);
