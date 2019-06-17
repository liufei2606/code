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
        $this->serv = new swoole_websocket_server("0.0.0.0", 9501);
        $this->serv->set(['worker_num' => 2,
        //开启2个worker进程
        'max_request' => 4,
        //每个worker进程 max_request设置为4次
        'task_worker_num' => 4,
        //开启4个task进程
        'dispatch_mode' => 4,
        //数据包分发策略 - IP分配
        'daemonize' => false,
        //守护进程(true/false)
        ]);
        $this->serv->on('Start', [$this, 'onStart']);
        $this->serv->on('Open', [$this, 'onOpen']);
        $this->serv->on("Message", [$this, 'onMessage']);
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

    public function onOpen($serv, $request) {
        echo "#### onOpen ####" . PHP_EOL;
        echo "server: handshake success with fd{$request->fd}" . PHP_EOL;
        $serv->task(['type' => 'login']);
        echo "########" . PHP_EOL . PHP_EOL;
    }

    public function onTask($serv, $task_id, $from_id, $data) {
        echo "#### onTask ####" . PHP_EOL;
        echo "#{$serv->worker_id} onTask: [PID={$serv->worker_pid}]: task_id={$task_id}" . PHP_EOL;
        $msg = '';
        switch ($data['type']) {
            case 'login':
                $msg = '我来了...';
                break;

            case 'speak':
                $msg = $data['msg'];
                break;
        }
        foreach ($serv->connections as $fd) {
            $connectionInfo = $serv->connection_info($fd);
            if ($connectionInfo['websocket_status'] == 3) {
                $serv->push($fd, $msg);
                //长度最大不得超过2M
                
            }
        }
        $serv->finish($data);
        echo "########" . PHP_EOL . PHP_EOL;
    }

    public function onMessage($serv, $frame) {
        echo "#### onMessage ####" . PHP_EOL;
        echo "receive from fd{$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}" . PHP_EOL;
        $serv->task(['type' => 'speak', 'msg' => $frame->data]);
        echo "########" . PHP_EOL . PHP_EOL;
    }

    public function onFinish($serv, $task_id, $data) {
        echo "#### onFinish ####" . PHP_EOL;
        echo "Task {$task_id} 已完成" . PHP_EOL;
        echo "########" . PHP_EOL . PHP_EOL;
    }

    public function onClose($serv, $fd) {
        echo "#### onClose ####" . PHP_EOL;
        echo "client {$fd} closed" . PHP_EOL;
        echo "########" . PHP_EOL . PHP_EOL;
    }
}
$server = new Server();