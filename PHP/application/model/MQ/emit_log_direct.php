<?php

require_once __DIR__.'/../../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$pdoection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $pdoection->channel();

$channel->exchange_declare('direct_logs', 'direct', false, false, false);
$serverity = isset($argv[1]) && !empty($argv[1]) ? $argv[1] : 'info';

$data = implode(' ', array_slice($argv, 2));

if (empty($data)) {
    $data = "info: Hello World!";
}
$msg = new AMQPMessage($data);

$channel->basic_publish($msg, 'direct_logs', $serverity);

echo " [x] Sent ",$serverity, ':', $data, "\n";

$channel->close();
$pdoection->close();
// php PHP/MQ/emit_log_direct.php warning "Run"
