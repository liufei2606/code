<?php

use Swoole\Coroutine as co;

class Http
{
    private $server;

    public function __construct()
    {
        $this->server = new swoole_http_server("0.0.0.0", 9501);
        $this->server->set([
            'worker_num' => 2, //开启2个worker进程
            'max_request' => 2, //每个worker进程 max_request设置为4次
            'task_worker_num' => 2,
            'document_root' => '/Users/henry/Workspace/Code/PHP/syntax/Swoole/Server/data',
            'enable_static_handler' => true,
            'daemonize' => false, //守护进程(true/false)
        ]);

        $this->server->on('WorkerStart', [$this, 'onWorkerStart']);
        $this->server->on('ManagerStart', [$this, 'onManagerStart']);
        $this->server->on('Start', [$this, 'onStart']);
        $this->server->on("Request", [$this, 'onRequest']);
        $this->server->on('Receive', function ($serv, $fd, $from_id, $data) {
        });
        $this->server->on('Task', function ($serv, $task) {
            echo "#### Task ####".PHP_EOL;
        });
        $this->server->on('Finish', function ($serv, $task_id, $data) {
            echo "#### Finsh ####".PHP_EOL;
        });

        $this->server->start();
    }

    public function onStart($server)
    {
        echo "#### onStart ####".PHP_EOL;
        # swoole_set_process_name is not supported on MacOS
        // swoole_set_process_name('swoole_process_server_master');
        echo "SWOOLE ".SWOOLE_VERSION." SERVICE has Started".PHP_EOL;
        echo "master_pid: {$server->master_pid}".PHP_EOL; //管理进程的PID，通过向管理进程发送SIGUSR1信号可实现柔性重启
        echo "manager_pid: {$server->manager_pid}".PHP_EOL; //主进程的PID，通过向主进程发送SIGTERM信号可安全关闭服务器
        foreach ($server->connections as $key => $value) {
            echo $value."\n";
        }

        echo '########'.PHP_EOL;
    }

    public function onManagerStart($server)
    {
        echo "#### onManagerStart ####".PHP_EOL;
        // swoole_set_process_name('swoole_process_server_manager');
    }

    public function onWorkerStart($server, $worker_id)
    {
        echo "#### onWorkerStart ####".PHP_EOL;
        // swoole_set_process_name('swoole_process_server_worker');
        echo "worker_pid: {$worker_id}".PHP_EOL;

        spl_autoload_register(function ($className) {
            $classPath = __DIR__.'/../controllers/'.$className.'Controller.php';
            if (is_file($classPath)) {
                require "{$classPath}";
                return;
            }
        });
    }

    public function onRequest($request, $response)
    {
        $response->header('Server', 'SwooleServer');
        $response->header('context-Type', 'text/html;charset=utf-8');

        $server = $request->server;
        $path_info = $server['path_info'];

        $context = [
            'date:' => date("Ymd H:i:s"),
            'post:' => $request->post,
            'Header:' => $request->header,
            'Get:' => $request->get,
        ];

        co::writeFile(__DIR__.'/access.log', json_encode($context), FILE_APPEND);

        if ($path_info == '/favicon.ico' || $server['request_uri'] == '/favicon.ico') {
            $response->end();
            return;
        }

        $controller = 'index';
        $method = 'home';
        if ($path_info != '/') {
            // http://127.0.0.1:9501/index/home
            $path_info = explode('/', $path_info);
            if (!is_array($path_info)) {
                $response->status(404);
                $response->end("URL isn't exist");
            }

            $count_path_info = count($path_info);
            if ($count_path_info > 4) {
                $response->status(404);
                $response->end("URL isn't exist");
            }
            $controller = (isset($path_info[1]) && !empty($path_info[1])) ? $path_info[1] : $controller;
            $method = (isset($path_info[2]) && !empty($path_info[2])) ? $path_info[2] : $method;

            // list($controller, $action) = explode('/', trim($request->server['request_uri'], '/'));
        }
        // $response->get()|post()|cookie()
        $result = "class 不存在";
        if (class_exists($controller)) {
            $class = new $controller();
            $result = "method 不存在";
            if (method_exists($controller, $method)) {
                $result = $class->$method($request);
                //根据 $controller, $action 映射到不同的控制器类和方法
                // (new $controller)->$action($request, $response);
            }
        }

        $response->end($result);
    }
}

$server = new Http();
