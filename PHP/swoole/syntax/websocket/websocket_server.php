<?php

$server = new swoole_websocket_server("0.0.0.0", 9502);

$server->on('open', function (Swoole\WebSocket\Server $server, $request) {
    echo "server: handshake success with fd_{$request->fd}\n";
    $server->push($request->fd, "hello, welcome\n");
});

$server->on('message', function (Swoole\WebSocket\Server $server, $frame) {
    echo "Request Message: {$frame->data}, opcode:{$frame->opcode},fin:{$frame->finish}\n";
    $server->push($frame->fd, "server response: {$frame->data}");
});

$server->on('close', function (Swoole\WebSocket\Server $server, $fd) {
    echo "client-{$fd} is closed\n";
});

$server->start();
