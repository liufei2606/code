<?php

use Swoole\Coroutine\Http\Client;

//此方法记录执行时间
function timediff($time)
{
    return microtime(true) - $time;
}

//创建http server
$http = new Swoole\Http\Server("0.0.0.0", 9501);
$http->set([
    //"daemonize" => true,
    "worker_num" => 1,
]);

$http->on('request', function ($request, $response) {

    // $redis = new Swoole\Coroutine\Redis();
    // $redis->connect('127.0.0.1', '6379');
    // $vaule = $redis->get($request->get['key']);
    // $response->end($vaule);

    //浏览器会自动发起这个请求，这也是很多人碰到的一个问题：
    //为什么我浏览器打开网站，收到了两个请求?
    if ($request->server['path_info'] == '/favicon.ico') {
        $response->end('');
        return;
    }

    $time = microtime(true);
    $response->header("context-type", "text/html; charset=UTF-8");
    $response->write("1. 接受请求，此处被执行, 第".__LINE__."行， 时间".$time."<br/>");

    //启动第一个协程
    go(function () use ($response) {
        $time = microtime(true);
        $response->write("2. 进入第一个协程，发起http请求taobao, 第".__LINE__."行, 时间:".$time."<br/>");

        //启动一个协程客户端client，请求淘宝首页
        $cli = new Client('www.taobao.com', 443, true);
        $cli->setHeaders([
            'Host' => "www.taobao.com",
            "User-Agent" => 'Chrome/49.0.2587.3',
            'Accept' => 'text/html,application/xhtml+xml,application/xml',
            'Accept-Encoding' => 'gzip',
        ]);
        $cli->set(['timeout' => 1]);
        //调用get方法，协程挂起，
        $cli->get('/index.php');
        //会等待i/o数据返回，才会继续执行下面
        $response->write("7. get回taobao数据，唤起协程，此处被执行, 第".__LINE__."行, 执行时间".timediff($time)."<br/>");
        $cli->close();
    });
    //上面get挂起协程后，后立马执行这一行
    $response->write("3 cli->get时挂起协程了，此处被执行,不会被阻塞, 第".__LINE__."行, 时间:".microtime(true)."<br/>");

    //启动第二个协程
    go(function () use ($response) {
        $time = microtime(true);
        $response->write("4. 进入第二个协程，发起http请求baidu, 第".__LINE__."行, 时间:".$time."<br/>");
        //启动一个协程客户端client，请求百度首页
        $cli = new Client('www.baidu.com', 443, true);
        $cli->setHeaders([
            'Host' => "www.baidu.com",
            "User-Agent" => 'Chrome/49.0.2587.3',
            'Accept' => 'text/html,application/xhtml+xml,application/xml',
            'Accept-Encoding' => 'gzip',
        ]);
        $cli->set(['timeout' => 1]);
        //调用get方法，协程挂起，
        $cli->get('/index.php');
        //会等待i/o数据返回，才会继续执行下面
        $response->write("6. get回baidu数据，唤起协程，此处被执行，正常这个先返回，因为ping百度更快，说明两个协程也是并发执行的, 第".__LINE__."行, 执行时间".timediff($time)."<br/>");
        $cli->close();
    });
    //第二个协程get时挂起，执行到这一步
    $response->write("5 cli->get时挂起协程了，此处被执行,不会被阻塞, 第".__LINE__."行, 时间:".microtime(true)."<br/>");
});

$http->start();
