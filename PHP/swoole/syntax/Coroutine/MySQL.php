<?php

go(function () {
    $swoole_mysql = new Swoole\Coroutine\MySQL();

    $swoole_mysql->connect([
        'host' => '127.0.0.1',
        'user' => 'root',
        'password' => "123456Ac&",
        'database' => 'test'
    ]);

    $res = $swoole_mysql->query('select * from user');
    if ($res === false) {
        return;
    }
    foreach ($res as $key => $value) {
        echo $value['id'].':'.$value['name'].PHP_EOL;
    }
});

# 用 Swoole\Http\Server 的 onRequest 事件回调函数时，底层会调用 C 函数 coro_create 创建一个协程（#1位置），同时保存这个时间点的 CPU 寄存器状态和 ZendVM 堆栈信息；
# 调用 mysql->connect 时会发生 IO 操作，底层会调用 C 函数 coro_save 保存当前协程的状态，包括 ZendVM 上下文以及协程描述信息，并调用 coro_yield 让出程序控制权，当前的请求会挂起（#2位置）；
# 协程让出程序控制权后，会继续进入 HTTP 服务器的事件循环处理其他事件，这时 Swoole 可以继续去处理其他客户端发来的请求；
# 当数据库 IO 事件完成后，MySQL 连接成功或失败，底层调用 C 函数 coro_resume 恢复对应的协程，恢复 ZendVM 上下文，继续向下执行 PHP 代码（#3位置）；
# mysql->query 的执行过程与 mysql->connect 一样，也会触发 IO 事件并进行一次协程切换调度；
# 所有操作完成后，调用 end 方法返回结果，并销毁此协程
$server = new Swoole\Http\Server('127.0.0.1', 9501, SWOOLE_BASE);
$server->on('Request', function ($request, $response) {
    $mysql = new Swoole\Coroutine\MySQL();
    #2
    $res = $mysql->connect([
        'host' => '127.0.0.1',
        'user' => 'root',
        'password' => 'root',
        'database' => 'test',
    ]);
    #3
    if ($res == false) {
        $response->end("MySQL connect fail!");
        return;
    }
    $ret = $mysql->query('show tables', 2);
    $response->end("swoole response is ok, result=".var_export($ret, true));
    $mysql->close();
});

$server->start();
# http://127.0.0.1:9501