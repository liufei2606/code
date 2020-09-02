<?php

class AsyMysql
{

    public $db = '';
    public $config = [
        'host' => '127.0.0.1',
        'user' => 'root',
        'password' => '123456Ac&',
        'database' => 'test',
        'charset' => 'utf8', //指定字符集
        'timeout' => 2,  // 可选：连接超时时间（非查询超时时间），默认为SW_MYSQL_CONNECT_TIMEOUT（1.0）
    ];

    public function __construct()
    {
        $this->db = new Swoole\MySQL;
    }

    public function exexute()
    {
        $this->db->connect($this->config, function ($db, $r) {
            if ($r === false) {
                var_dump($db->connect_errno, $db->connect_error);
                die;
            }

            $sql = 'show tables';

            $db->query($sql, function (swoole_mysql $db, $r) {
                if ($r === false) {
                    var_dump($db->error, $db->errno);
                } elseif ($r === true) {
                    var_dump($db->affected_rows, $db->insert_id);
                } else {
                    // 查询
                    var_dump($r);
                }
                var_dump($r);
                $db->close();
            });
        });
    }
}

$instance = new AsyMysql();
$instance->exexute();



