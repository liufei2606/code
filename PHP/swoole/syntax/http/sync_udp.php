<?php

$client = new Swoole\Client(SWOOLE_SOCK_UDP);
$client->connect('127.0.0.1', 9502, 1);

$i = 0;
while ($i < 10) {
    $client->send($i."\n");
    $message = $client->recv();
    echo "Get Message From Server:{$message}\n";
    $i++;
}
