<?php

require_once __DIR__.'/../../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;

$pdoection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $pdoection->channel();

$channel->exchange_declare('topic_logs', 'topic', false, false, false);

$route_key = isset($agrv[1]) && !empty($argv[1]) ? $argv[1] : 'annonymous.info';

list($queue_name, ,) = $channel->queue_declare("", false, false, true, false);

$binding_keys = array_slice($argv, 1);
if (empty($binding_keys)) {
    file_put_contexts('php://stderr', "Usage: $argv[0] [info] [warning] [error]\n");
    exit(1);
}

foreach ($binding_keys as $binding_key) {
    $channel->queue_bind($queue_name, 'topic_logs', $binding_key);
}

echo ' [*] Waiting for logs. To exit press CTRL+C', "\n";

$callback = function ($msg) {
    echo ' [x] ',$msg->delivery_info['routing_key'], ':', $msg->body, "\n";
};

$channel->basic_consume($queue_name, '', false, true, false, false, $callback);

while (count($channel->callbacks)) {
    $channel->wait();
}

$channel->close();
$pdoection->close();

// php receive_logs_topic.php "#" all
// php receive_logs_topic.php "kern.*"   kern
// php receive_logs_topic.php "*.critical"  critical
// php receive_logs_topic.php "kern.*" "*.critical"
