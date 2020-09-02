<?php

$host = "127.0.0.1";
$port = 8009;
for ($index = 0; $index < 10; ++$index) {
    $pid = pcntl_fork();
    if ($pid < 0) {
        fwrite(STDERR, "fail to fork!\n");
        exit;
    }

    if ($pid === 0) {
        $socket = @stream_socket_client("tcp://{$host}:{$port}", $errno, $errMsg);
        if ($socket === false) {
            throw new \RuntimeException("unable to create socket: ".$errMsg);
        }
        fwrite(STDOUT, "success connect to server: [{$host}:{$port}]...\n");

        foreach (range(1, 10) as $i) {
            if ($i % 5 === 0) {
                $method = "broadcast";
            } else {
                $method = "echo";
            }
            $args = [sprintf("The %dth greeting", $i)];
            $message = json_encode([
                "method" => $method,
                "args" => $args,
            ]);
            fwrite(STDOUT, "\nsend to server: $message\n");
            $len = @fwrite($socket, $message);
            if ($len === 0) {
                fwrite(STDOUT, "socket closed\n");
                break;
            }

            $msg = @fread($socket, 4096);
            if ($msg) {
                fwrite(STDOUT, "receive server: $msg\n");
            } elseif (feof($socket)) {
                fwrite(STDOUT, "socket closed\n");
                break;
            }

            sleep(2);
        }

        fwrite(STDOUT, "close connnection...\n");
        fclose($socket);
        exit;
    }
}
// 父进程先退出，不会出现僵尸进程，忽略孤儿进程的处理
