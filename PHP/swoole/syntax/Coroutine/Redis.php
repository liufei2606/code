<?php

const REDIS_SERVER_HOST = '127.0.0.1';
const REDIS_SERVER_PORT = 6379;

go(function () {
    $redis = new Swoole\Coroutine\Redis();
    $redis->connect(REDIS_SERVER_HOST, REDIS_SERVER_PORT);
    $redis->setDefer();
    $redis->set('key1', 'value3');

    $redis2 = new Swoole\Coroutine\Redis();
    $redis2->connect(REDIS_SERVER_HOST, REDIS_SERVER_PORT);
    $redis2->setDefer();
    $redis2->get('key1');

    $result1 = $redis->recv();
    $result2 = $redis2->recv();

    var_dump($result1, $result2);
});


//  Swoole 会在 TCP Server 和 HTTP Server 回调函数中会自动开启协程，所以不需要显式通过 go 关键字启动协程，然后我们可以在回调函数中使用 MySQL 和 Redis 客户端协程组件发起请求
// etDefer 机制，绝大部分协程组件都支持 setDefer，该机制可以将请求响应式的接口拆分为两个步骤：先发送数据, 再并发收取响应结果
// 建立连接和发送数据的耗时」相较于「等待响应的耗时」来说可以忽略不计, 所以可以简单理解为 defer 模式下, 多个客户端的请求响应是并发的（实际上只有接收响应是并发的，建立连接和发送请求是串行的）
// 设置 setDefer(true) 后，通过 Redis 或 MySQL 客户端发起请求，将不再等待服务器返回结果，而是在发送请求之后，立即返回 true。在此之后可以继续发起其他 Redis、MySQL 请求，最后再使用 recv() 方法接收响应内容
$server = new \Swoole\Http\Server('127.0.0.1', 9588);

$server->on('Request', function ($request, $response) {

    var_dump(time());

    $mysql = new Swoole\Coroutine\MySQL();
    $mysql->connect([
        'host' => '127.0.0.1',
        'user' => 'root',
        'password' => 'root',
        'database' => 'laravel58',
    ]);
    $mysql->setDefer();
    $mysql->query('select sleep(3)');

    var_dump(time());

    $redis1 = new Swoole\Coroutine\Redis();
    $redis1->connect('127.0.0.1', 6379);
    $redis1->setDefer();
    $redis1->set('hello', 'world');

    var_dump(time());

    $redis2 = new Swoole\Coroutine\Redis();
    $redis2->connect('127.0.0.1', 6379);
    $redis2->setDefer();
    $redis2->get('hello');

    $result1 = $mysql->recv();
    $result2 = $redis2->recv();

    var_dump($result1, $result2, time());

    $response->end('Request Finish: '.time());
});

$server->start();
