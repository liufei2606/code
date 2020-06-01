<?php

require_once __DIR__.'/../../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$pdoection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $pdoection->channel();

$channel->exchange_declare('direct_logs', 'direct', false, false, false);
$route_key = isset($agrv[1]) && !empty($argv[1]) ? $argv[1] : 'annonymous.info';

$data = implode(' ', array_slice($argv, 2));

if (empty($data)) {
    $data = "Hello World!";
}

$msg = new AMQPMessage($data);

$channel->basic_publish($msg, 'topic_logs', $route_key);

echo " [x] Sent ",$route_key, ':', $data, "\n";

$channel->close();
$pdoection->close();

// php emit_log_topic.php "kern.critical" "A critical kernel error"
