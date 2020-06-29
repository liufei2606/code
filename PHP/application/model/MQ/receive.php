<?php

require_once __DIR__.'/../../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;

$pdoection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $pdoection->channel();
$channel->queue_declare('hello', false, false, false, false);
echo '[*] Waiting for messages, To exit press CTRL + C', "\n";

$callback = function ($msg) {
    echo "[x] Recevied ", $msg->body, "\n";
};
$channel->basic_consume('hello', '', false, true, false, false, $callback);

while (count($channel->callbacks)) {
    $channel->wait();
}
$channel->close();
$pdoection->close();
