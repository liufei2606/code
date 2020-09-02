<?php

namespace Http\Sync;

class Client
{
    private $client;

    public function __construct()
    {
        $this->client = new swoole_client(SWOOLE_SOCK_TCP);
        $this->connect();
    }

    public function connect()
    {
        if (!$this->client->connect("127.0.0.1", 9501, 1)) {
            die("Error: {$this->client->errMsg}[{$this->client->errCode}]");
        }
        // 发送数据
        fwrite(STDOUT, "请输入消息 Please input msg：");
        $msg = trim(fgets(STDIN));
        $this->client->send($msg);

        // 接受server数据
        $message = $this->client->recv();
        echo "Get Message From Server:{$message}\n";
        $this->client->close();
    }
}

$client = new Client();
