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

    Route::resource('article','ArticleController');
    Route::resource('column','ColumnController');
    Route::resource('tag','TagController');
    Route::resource('message','MessageController');

    Route::GET('protobuf/send','ProtobufController@send')->name('protobuf.send');
    Route::GET('protobuf/receive','ProtobufController@receive')->name('protobuf.receive');

});
