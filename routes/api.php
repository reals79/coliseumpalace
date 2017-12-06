<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/check-idno', [
    'uses' => 'ApiController@checkIdno'
]);
Route::post('/register/{user}', [
    'uses' => 'ApiController@register'
]);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user()->load('records');
});
Route::post('/user/save', [
    'uses' => 'ApiController@userSave'
])->middleware('auth:api');

Route::get('/settings', [
    'uses' => 'ApiController@settings'
])->middleware('auth:api');
Route::post('/settings/save', [
    'uses' => 'ApiController@settingsSave'
])->middleware('auth:api');

Route::get('/alerts', [
    'uses' => 'ApiController@alerts'
])->middleware('auth:api');

Route::get('/messages', [
    'uses' => 'ApiController@messages'
])->middleware('auth:api');

Route::get('/leasing', [
    'uses' => 'ApiController@leasing'
])->middleware('auth:api');

Route::get('/services', [
    'uses' => 'ApiController@services'
])->middleware('auth:api');

Route::post('/post-data', [
    'uses' => 'ApiController@dataProcess'
]);

Route::get('/post-data', [
    'uses' => 'ApiController@dataProcess'
]);

Route::get('/data-process', [
    'uses' => 'DataController@dataProcess'
]);