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
});

$server->start();

//并发编程场景如下：
//高并发服务，如秒杀系统、高性能 API 接口、RPC 服务器，使用协程模式，服务的容错率会大大增加，某些接口出现故障时，不会导致整个服务崩溃；
//    爬虫，可实现非常强大的并发能力，即使是非常慢速的网络环境，也可以高效地利用带宽；
//    即时通信服务，如 IM 聊天、游戏服务器、物联网、消息服务器等等，可以确保消息通信完全无阻塞，每个消息包均可即时地被处理。

//问题：
//    协程需要为每个并发保存栈内存并维护对应的虚拟机状态，如果程序并发很大可能会占用大量内存；
//    协程调度会增加额外的一些 CPU 开销。

//协程在底层实现上是单线程的，因此同一时间只有一个协程在工作，协程的执行是串行的，这与线程不同，多个线程会被操作系统调度到多个 CPU 并行执行。
//
//一个协程正在运行时，其他协程会停止工作。当前协程执行阻塞 IO 操作时会挂起，底层调度器会进入事件循环。当有 IO 完成事件时，底层调度器恢复事件对应的协程的执行。
//
//在 Swoole 中对 CPU 多核的利用，仍然依赖于 Swoole 引擎的多进程机制。
