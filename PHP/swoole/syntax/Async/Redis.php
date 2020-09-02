<?php

$redis = new Swoole\Redis; // swoole_redis;
$redis->connect('127.0.0.1', 6379, function ($redis, $result) {
    if ($result === false) {
        echo "connect to redis server failed.\n";
        return;
    }
    $redis->set('test_key', 'value', function ($redis, $result) {
        $redis->get('test_key', function ($redis, $result) {
            var_dump($result);
        });
    });
});

// 发布 订阅
$client->on('message', function (swoole_redis $client, $result) {
    var_dump($result);
    static $more = false;
    if (!$more and $result[0] == 'message') {
        echo "subscribe new channel\n";
        $client->subscribe('msg_1', 'msg_2');
        $client->unsubscribe('msg_0');
        $more = true;
    }
});
