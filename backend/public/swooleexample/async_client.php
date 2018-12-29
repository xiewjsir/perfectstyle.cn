<?php

$client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);

//注册连接成功回调
$client->on("connect", function($cli) {
    $cli->send("hello world\n");
});

//注册数据接收回调
$client->on("receive", function($cli, $data){
    echo "Received: ".$data."\n";
});

//注册连接失败回调
$client->on("error", function($cli){
    echo "Connect failed\n";
});

//注册连接关闭回调
$client->on("close", function($cli){
    echo "Connection close\n";
});

//发起连接
$client->connect('127.0.0.1', 9501, 0.5);

/*
$db = new Swoole\MySQL;
$server = array(
    'host' => '127.0.0.1',
    'user' => 'test',
    'password' => 'test',
    'database' => 'test',
);

$db->connect($server, function ($db, $result) {
    $db->query("show tables", function (Swoole\MySQL $db, $result) {
        var_dump($result);
        $db->close();
    });
});


$redis = new Swoole\Redis;
$redis->connect('127.0.0.1', 6379, function ($redis, $result) {
    $redis->set('test_key', 'value', function ($redis, $result) {
        $redis->get('test_key', function ($redis, $result) {
            var_dump($result);
        });
    });
});



$cli = new Swoole\Http\Client('127.0.0.1', 80);
$cli->setHeaders(array('User-Agent' => 'swoole-http-client'));
$cli->setCookies(array('test' => 'value'));

$cli->post('/dump.php', array("test" => 'abc'), function ($cli) {
    var_dump($cli->body);
    $cli->get('/index.php', function ($cli) {
        var_dump($cli->cookies);
        var_dump($cli->headers);
    });
});
*/