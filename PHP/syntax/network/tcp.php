<?php

require('HttpProtocol.php');

$server = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_bind($server, '127.0.0.1', '8889');
socket_listen($server);

while (true) {
    // accept
    $client = socket_accept($server);
    if (! $client) {
        continue;
    }
    $request = socket_read($client, 1024);

    // 查看接收到的内容
    // var_dump($request);

    /**
    * HTTP
    */
    $http = new HttpProtocol;
    $http->originRequestcontextString = $request;
    $http->request($request);
    $http->response("Hello World");
    $http->response($request);
    socket_write($client, $http->responseData);

    socket_close($client);
    echo socket_strerror(socket_last_error($server)) . "\n";
}
