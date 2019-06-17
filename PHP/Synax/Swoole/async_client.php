<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
// +----------------------------------------------------------------------+
// | PHP version 5                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2004 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 3.0 of the PHP license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.php.net/license/3_0.txt.                                  |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: Original Author <author@example.com>                        |
// |          Your Name <you@example.com>                                 |
// +----------------------------------------------------------------------+
//
// $Id:$

class Client {
    private $client;
    public function __construct() {
        $this->client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);
        $this->client->on('Connect', [$this, 'onConnect']);
        $this->client->on('Receive', [$this, 'onReceive']);
        $this->client->on('Close', [$this, 'onClose']);
        $this->client->on('Error', [$this, 'onError']);
    }
    public function connect() {
        if (!$fp = $this->client->connect("127.0.0.1", 9501, 1)) {
            echo "Error: {$fp->errMsg}[{$fp->errCode}]" . PHP_EOL;
            return;
        }
    }

    public function onConnect($cli) {
        fwrite(STDOUT, "输入Email:");
        swoole_event_add(STDIN, function () {
            fwrite(STDOUT, "输入Email:");
            $msg = trim(fgets(STDIN));
            $this->send($msg);
        });
    }

    public function onReceive($cli, $data) {
        echo PHP_EOL . "Received: " . $data . PHP_EOL;
    }

    public function send($data) {
        $this->client->send($data);
    }

    public function onClose($cli) {
        echo "Client close connection" . PHP_EOL;
    }

    public function onError() {
		echo "Connection close\n";
    }
}
$client = new Client();
$client->connect();

