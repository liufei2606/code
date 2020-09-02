<?php

$serv = new swoole_server("127.0.0.1", 9501);
// ps -ef | grep TCP_server.php
// netstat -an | grep 端口
$serv->set([
    'worker_num' => 8, // worker  cpu * 1-4
    'max_request' => 10000
]);

/**
 * 监听连接进入事件
 *
 * $fd  客户端连接的唯一表示
 * $reactor_id 线程id
 */
$serv->on('connect', function ($serv, $fd, $reactor_id) {
    echo "Client: {$reactor_id} - {$fd} Connect.\n";
});

$serv->on('receive', function ($serv, $fd, $reactor_id, $data) {
    $serv->send($fd, "Server: $reactor_id - $fd - Data：".$data.PHP_EOL);
});

$serv->on('close', function ($serv, $fd) {
    echo "Client: Close.\n";
});

$serv->start();

// telnet 127.0.0.1 9501
// hello
