<?php

$port = 8009;
$socket = @stream_socket_server("tcp://0.0.0.0:$port", $errno, $errMsg);
if ($socket === false) {
    throw new \RuntimeException("fail to listen on port: {$port}!");
}
fwrite(STDOUT, "socket server listen on port: {$port}" . PHP_EOL);
stream_set_blocking($socket, false);

while (true) {
    $client = @stream_socket_accept($socket);
    if ($client == false) {
        continue;
    }

    fwrite(STDOUT, "client:" . (int)$client . " connnected.\n");
    @fwrite($client, "Welcome aboard!\n");

    while (true) {
        $msg = @fread($client, 4096);
        if ($msg) {
            fwrite(STDOUT, "\nreceive client: $msg\n");
            // echo
            @fwrite($client, $msg);
        } elseif (feof($client)) {
            fwrite(STDOUT, "client:" . (int)$client . " disconnnect!\n");
            fclose($client);
            break;
        }
    }
}
