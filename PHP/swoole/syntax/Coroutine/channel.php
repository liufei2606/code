<?php
/**
 * 协程通信
 */
$chan = new chan(2);

# 协程1
go(function () use ($chan) {
    $result = [];
    for ($i = 0; $i < 2; $i++) {
        $result += $chan->pop();
    }
    var_dump($result);
});

# 协程2
go(function () use ($chan) {
    $cli = new Swoole\Coroutine\Http\Client('www.qq.com', 80);
    $cli->set(['timeout' => 10]);
    $cli->setHeaders([
        'Host' => "www.qq.com",
        "User-Agent" => 'Chrome/49.0.2587.3',
        'Accept' => 'text/html,application/xhtml+xml,application/xml',
        'Accept-Encoding' => 'gzip',
    ]);
    $ret = $cli->get('/');
    // $cli->body 响应内容过大，这里用 Http 状态码作为测试
    $chan->push(['www.qq.com' => $cli->statusCode]);
});

# 协程3
go(function () use ($chan) {
    $cli = new Swoole\Coroutine\Http\Client('www.163.com', 80);
    $cli->set(['timeout' => 10]);
    $cli->setHeaders([
        'Host' => "www.163.com",
        "User-Agent" => 'Chrome/49.0.2587.3',
        'Accept' => 'text/html,application/xhtml+xml,application/xml',
        'Accept-Encoding' => 'gzip',
    ]);
    $ret = $cli->get('/');
    // $cli->body 响应内容过大，这里用 Http 状态码作为测试
    $chan->push(['www.163.com' => $cli->statusCode]);
});


//三个子协程之间数据是相互隔离的，所以我们通过 Swoole\Coroutine\Channel （即通道）实现协程之间的数据共享和通信，初始化其缓冲空间为 3，然后通过 use 方式将其引入到子协程中，把响应结果通过 push 方法放到 Channel 里面，接下来在服务端 onRequest 回调函数末尾通过一个循环将 Channel 中的数据通过 pop 方法依次取出来放到数组 $results 中，最后通过 $response->end() 方法将结果以 JSON 格式返回给客户端
$server = new \Swoole\Http\Server('127.0.0.1', 9588);
$server->on('Request', function ($request, $response) {
    $channel = new \Swoole\Coroutine\Channel(3);
    go(function () use ($channel) {
        var_dump(time());
        $mysql = new Swoole\Coroutine\MySQL();
        $mysql->connect([
            'host' => '127.0.0.1',
            'user' => 'root',
            'password' => 'root',
            'database' => 'laravel58',
        ]);
        $result = $mysql->query('select sleep(3)');

        $channel->push($result);
    });

    go(function () use ($channel) {
        var_dump(time());

        $redis1 = new Swoole\Coroutine\Redis();
        $redis1->connect('127.0.0.1', 6379);
        $result = $redis1->set('hello', 'world');

        $channel->push($result);
    });

    go(function () use ($channel) {
        var_dump(time());

        $redis2 = new Swoole\Coroutine\Redis();
        $redis2->connect('127.0.0.1', 6379);

        $result = $redis2->get('hello');
        $channel->push($result);
    });

    $results = [];
    for ($i = 0; $i < 3; $i++) {
        $results[] = $channel->pop();
    }

    $response->end(json_encode([
        'data' => $results,
        'time' => time()
    ], JSON_THROW_ON_ERROR));
});

$server->start();