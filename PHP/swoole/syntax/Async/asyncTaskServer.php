<?php

class asyncTaskServer
{
    private $server;

    public function __construct()
    {
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

    public function onConnect($server, $fd)
    {
        echo "#### onConnect ####".PHP_EOL;
        echo "客户端:".$fd." 已连接".PHP_EOL;
        echo "########".PHP_EOL;
    }

    public function onStart(\Swoole\Server $server)
    {
        echo "#### onStart ####".PHP_EOL;
        echo "SWOOLE ".SWOOLE_VERSION." 服务已启动".PHP_EOL;
        echo "master_pid: {$server->master_pid}".PHP_EOL;
        echo "manager_pid: {$server->manager_pid}".PHP_EOL;
        echo "########".PHP_EOL;
    }

    public function onReceive(\Swoole\Server $server, $fd, $from_id, $data)
    {
        echo "#### onReceive ####".PHP_EOL;
        echo "worker_pid: {$server->worker_pid}".PHP_EOL;
        echo "客户端:{$fd} 发来的Email:{$data}".PHP_EOL;
        $param = ['fd' => $fd, 'email' => $data];
        // 投递异步任务
        $task_id = $server->task(json_encode($param));
        if ($task_id === false) {
            echo "任务分配失败 Task ".$task_id.PHP_EOL;
        } else {
            echo "任务分配成功 Task ".$task_id.PHP_EOL;
        }
        echo "Dispath AsyncTask: id=$task_id".PHP_EOL;
        echo "########".PHP_EOL;
    }

    //处理异步任务
    public function onTask(\Swoole\Server $server, $task_id, $worker_id, $data)
    {
        echo "#### onTask ####".PHP_EOL;
        echo "#{$server->worker_id} onTask: [PID={$server->worker_pid}]: task_id={$task_id}".PHP_EOL;
        //业务代码
        for ($i = 1; $i <= 5; $i++) {
            sleep(1);
            echo "Task {$task_id} 已完成了 {$i}/5 的任务".PHP_EOL;
        }

        $data_arr = json_decode($data, true);
        $server->send($data_arr['fd'], 'Email:'.trim($data_arr['email']).',发送成功'.PHP_EOL);
        $server->finish($data);

        echo "########".PHP_EOL;
    }

    public function onFinish(\Swoole\Server $server, $task_id, $data)
    {
        echo "#### onFinish ####".PHP_EOL;
        echo "Task {$task_id} 已完成".PHP_EOL;
        echo "########".PHP_EOL;
        echo "AsyncTask[$task_id] Finish: $data".PHP_EOL;
    }

    public function onClose(\Swoole\Server $server, $fd)
    {
        echo "Client Close.".PHP_EOL;
    }
}

$server = new asynctaskserver();
