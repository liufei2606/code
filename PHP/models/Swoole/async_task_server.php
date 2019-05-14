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

class Server {
    private $serv;

    public function __construct() {
        $this->serv = new swoole_server('0.0.0.0', 9501);

        $this->serv->set([
        'worker_num' => 2, //开启2个worker进程
        'max_request' => 4, //每个worker进程 max_request设置为4次
        'task_worker_num' => 4, //开启4个task进程
        'dispatch_mode' => 2, //数据包分发策略 - 固定模式
        ]);

        $this->serv->on('Start', [$this, 'onStart']);
        $this->serv->on('Connect', [$this, 'onConnect']);
        $this->serv->on("Receive", [$this, 'onReceive']);
        $this->serv->on("Close", [$this, 'onClose']);
        $this->serv->on("Task", [$this, 'onTask']);
        $this->serv->on("Finish", [$this, 'onFinish']);
        $this->serv->start();
    }

    public function onStart($serv) {
        echo "#### onStart ####" . PHP_EOL;
        echo "SWOOLE " . SWOOLE_VERSION . " 服务已启动" . PHP_EOL;
        echo "master_pid: {$serv->master_pid}" . PHP_EOL;
        echo "manager_pid: {$serv->manager_pid}" . PHP_EOL;
        echo "########" . PHP_EOL . PHP_EOL;
    }

    public function onConnect($serv, $fd) {
        echo "#### onConnect ####" . PHP_EOL;
        echo "客户端:" . $fd . " 已连接" . PHP_EOL;
        echo "########" . PHP_EOL . PHP_EOL;
    }

    public function onReceive($serv, $fd, $from_id, $data) {
        echo "#### onReceive ####" . PHP_EOL;
        echo "worker_pid: {$serv->worker_pid}" . PHP_EOL;
        echo "客户端:{$fd} 发来的Email:{$data}" . PHP_EOL;
        $param = ['fd' => $fd, 'email' => $data];
        $rs = $serv->task(json_encode($param));
        if ($rs === false) {
            echo "任务分配失败 Task " . $rs . PHP_EOL;
        } else {
            echo "任务分配成功 Task " . $rs . PHP_EOL;
        }
        echo "########" . PHP_EOL . PHP_EOL;
    }

    public function onTask($serv, $task_id, $from_id, $data) {
        echo "#### onTask ####" . PHP_EOL;
        echo "#{$serv->worker_id} onTask: [PID={$serv->worker_pid}]: task_id={$task_id}" . PHP_EOL;
        //业务代码
        for ($i = 1; $i <= 5; $i++) {
            sleep(2);
            echo "Task {$task_id} 已完成了 {$i}/5 的任务" . PHP_EOL;
        }
        $data_arr = json_decode($data, true);
        $serv->send($data_arr['fd'], 'Email:' . $data_arr['email'] . ',发送成功');
        $serv->finish($data);
        echo "########" . PHP_EOL . PHP_EOL;
    }

    public function onFinish($serv, $task_id, $data) {
        echo "#### onFinish ####" . PHP_EOL;
        echo "Task {$task_id} 已完成" . PHP_EOL;
        echo "########" . PHP_EOL . PHP_EOL;
    }
    
    public function onClose($serv, $fd) {
        echo "Client Close." . PHP_EOL;
    }
}

$server = new Server();