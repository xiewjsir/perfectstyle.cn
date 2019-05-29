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
Route::any('grpc', function () {
    phpinfo();
//    $client = new Helloworld\GreeterClient('localhost:50051', [
//        'credentials' => Grpc\ChannelCredentials::createInsecure(),
//    ]);
//    $request = new Helloworld\HelloRequest();
//    $name = !empty($argv[1]) ? $argv[1] : 'world';
//    $request->setName($name);
//    list($reply, $status) = $client->SayHello($request)->wait();
//    $message = $reply->getMessage();
});


