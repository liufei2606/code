<?php

//创建Server对象，监听 127.0.0.1:9501端口
$serv = new swoole_server("127.0.0.1", 9501);

//监听连接进入事件
$serv->on('connect', function ($serv, $fd) {
    echo "Client: Connect.\n";
    echo "Connection open: {$fd}\n";
});

//监听数据接收事件
$serv->on('receive', function ($serv, $fd, $from_id, $data) {
    $serv->send($fd, "Server: " . $data . PHP_EOL);
    $serv->send($fd, "fd: " . $fd . PHP_EOL);
    $serv->send($fd, "from_id: " . $from_id);
    // 是否 关闭进程
    // $serv->close($fd);
});

//监听连接关闭事件
$serv->on('close', function ($serv, $fd) {
    echo "Client: Close.\n";
});

//启动服务器
$serv->start();

// telnet 127.0.0.1 9501
// hello
