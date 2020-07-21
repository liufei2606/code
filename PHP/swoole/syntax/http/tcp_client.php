<?php

namespace Swoole;

// Swoole4以后通过协程来实现异步通信
go(function () {
    $client = new Coroutine\Client(SWOOLE_SOCK_TCP);
    // 尝试与指定 TCP 服务端建立连接（IP和端口号需要与服务端保持一致，超时时间为0.5秒）
    if ($client->connect("127.0.0.1", 9501, 0.5)) {
        $client->send("hello world\n");
        echo $client->recv();
        $client->close();
    } else {
        echo "connect failed.";
    }
});
