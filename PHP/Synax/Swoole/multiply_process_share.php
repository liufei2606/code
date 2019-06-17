<?php

$fds = array();
$server->on('connect', function ($server, $fd) {
    echo "connection open: {$fd}\n";
    global $fds;
    $fds[] = $fd;
    var_dump($fds);
});
