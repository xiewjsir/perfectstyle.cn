<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    Route::get('/debug-sentry', function () {
        throw new Exception('My first Sentry error22!');
    });

    Route::get('/debug-sentry33', function () {
        throw new Exception('My first Sentry error33!');
    });

    Route::GET('es/index','EsController@index')->name('es.index');
    Route::GET('es/search','EsController@search')->name('es.search');

    Route::get('/test/elastic', function () {
        $hosts = [
            'elasticsearch:9200',
        ];
        $client = \Elasticsearch\ClientBuilder::create()->setHosts($hosts)->build();
        try {
            $response = $client->info();
            return $response;
        } catch (\Exception $e) {
            return 'error: ' . $e->getMessage();
        }
    });

    Route::get('/test/log', function () {
        // 日志同时写入 文件系统 和 ElasticSearch 系统
        Log::info('写入成功啦，日志同时写入 文件系统 和 ElasticSearch 系统', ['code' => 0, 'msg' => '成功了，日志同时写入 文件系统 和 ElasticSearch 系统', 'data' => [1,2,3,4,5]]);
    });
});
