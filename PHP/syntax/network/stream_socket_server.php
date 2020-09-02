<?php

$port = 8009;
$socket = @stream_socket_server("tcp://0.0.0.0:$port", $errno, $errMsg);
if ($socket === false) {
    throw new \RuntimeException("fail to listen on port: {$port}!");
}
fwrite(STDOUT, "socket server listen on port: {$port}".PHP_EOL);
stream_set_blocking($socket, false);

// while (true) {
//     $client = @stream_socket_accept($socket);
//     if ($client == false) {
//         continue;
//     }

//     fwrite(STDOUT, "client:" . (int)$client . " connnected.\n");
//     @fwrite($client, "Welcome aboard!\n");

//     while (true) {
//         $msg = @fread($client, 4096);
//         if ($msg) {
//             fwrite(STDOUT, "\nreceive client: $msg\n");
//             // echo
//             @fwrite($client, $msg);
//         } elseif (feof($client)) {
//             fwrite(STDOUT, "client:" . (int)$client . " disconnnect!\n");
//             fclose($client);
//             break;
//         }
//     }
// }

$clients = [];
$changed = [];
while (true) {
    checkMessage();
    fwrite(STDOUT, "\nnew read message\n");
    accept();
    handleMessage();
}

function checkMessage()
{
    global $socket, $changed, $clients;
    $changed = array_merge([$socket], $clients);
    $write = null;
    $except = null;
    stream_select($changed, $write, $except, null);
}

function accept()
{
    global $socket, $changed, $clients;
    if (!in_array($socket, $changed)) {
        return;
    }

    while ($client = @stream_socket_accept($socket, 0)) {
        $clients[] = $client;

        fwrite(STDOUT, "client:".(int) $client." connnected.\n");
        fwrite($client, "welcome aboard!");
        stream_set_blocking($client, false);

        $key = array_search($client, $changed);
        unset($changed[$key]);
    }
}

function handleMessage()
{
    global $changed, $clients;
    foreach ($changed as $key => $client) {
        while (true) {
            $msg = @fread($client, 4096);
            if ($msg) {
                fwrite(STDOUT, "receive client ".(int) $client." message: $msg\n");
                $json = json_decode($msg, true);
                if ($json) {
                    $method = $json["method"];
                    if ($method === 'echo') {
                        @fwrite($client, $msg);
                    } else {
                        foreach ($clients as $cl) {
                            @fwrite($cl, "message from ".(int) $client.": $msg");
                        }
                    }
                }
            } else {
                if (feof($client)) {
                    fwrite(STDOUT, "\nclient ".(int) $client." closed.\n");
                    fclose($client);
                    $key = array_search($client, $clients);
                    unset($clients[$key]);
                }
                break;
            }
        }
    }
}
