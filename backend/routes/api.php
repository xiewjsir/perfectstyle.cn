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
Route::group(['namespace' => 'Api\V1'], function () {
    Route::post('auth/login', 'AuthController@login');

    Route::group(['middleware' => ['auth:api']],function(){
        Route::post('auth/logout', 'AuthController@logout');
        Route::post('auth/refresh', 'AuthController@refresh');
        Route::get('auth/user', 'AuthController@user');
    });

    Route::resource('article','ArticleController');
    Route::resource('column','ColumnController');
    Route::resource('tag','TagController');
    Route::resource('message','MessageController');
});
