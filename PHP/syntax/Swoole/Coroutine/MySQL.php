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
    if($res === false) {
        return;
    }
    foreach ($res as $key => $value) {
        echo $value['id'] . ':' .$value['name'] . PHP_EOL;
    }
});
