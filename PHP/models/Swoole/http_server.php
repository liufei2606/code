<?php

class HttpServer {
	private $server;
	 public function __construct() {
	    $this->server = new swoole_http_server("0.0.0.0", 9501);
	    $this->server->set([
		    'worker_num' => 1, //开启2个worker进程
		    'max_request' => 2, //每个worker进程 max_request设置为4次
		    'document_root' => '', 
		    'enable_static_handler' => true, 
		    'daemonize' => false, //守护进程(true/false)
	    ]);
	    $this->server->on('Start', [$this, 'onStart']);
	    $this->server->on('WorkerStart', [$this, 'onWorkerStart']);
	    $this->server->on('ManagerStart', [$this, 'onManagerStart']);
	    $this->server->on("Request", [$this, 'onRequest']);
	    $this->server->start();
	}

	public function onStart($server){
		echo "#### onStart ####" . PHP_EOL;
		swoole_set_process_name('swoole_process_server_master');
		echo "SWOOLE " . SWOOLE_VERSION . "SERVICE has Started" . PHP_EOL;
		echo "master_pid: {$server->master_pid}" . PHP_EOL;
		echo "manager_pid: {$server->manager_pid}" . PHP_EOL;
		echo '########' . PHP_EOL . PHP_EOL;
	}

	public function onManagerStart($server){
		echo "#### onManagerStart ####" . PHP_EOL;
		swoole_set_process_name('swoole_process_server_manager');
	}

	public function onWorkerStart($server, $worker_id){
		echo "#### onManagerStart ####" . PHP_EOL;
		swoole_set_process_name('swoole_process_server_worker');
		echo "worker_pid: {worker_id}" . 

		spl_autoload_register(function($className){
			$classPath = __DIR__ . '/../controllers/' . $className . 'Controller.php';
			if (is_file($classPath)) {
				require "{$classPath}";
				return;
			}
		});
	}

	public function onRequest($request, $response){
		$response->header('Server', 'SwooleServer');
		$response->header('Content-Type', 'text/html;charset=utf-8');
		$server = $request->server;
		$path_info = $server['path_info'];
		$request_url = $server['request_url'];

		if ($path_info == '/favico.ico' || $request_url == '/favico.ico') {
			return $response->end();
		}

		$controller = 'index';
		$method = 'home';

		if ($path_info != '/') {
			$path_info = explode('/', $path_info);

			if (!is_array($path_info)) {
				$response->status(404);
				$response->end("URL isn't exist");
			}
			if ($path_info[1] == 'favico.ico') {
				return;
			}

			$count_path_info = count($path_info);
			if ($count_path_info > 4) {
				$response->status(404);
				$response->end("URL isn't exist");
			}
			$controller = (isset($path_info[1]) && !empty($path_info[1])) ? $path_info[1] : $controller;  
			$method = (isset($path_info[2]) && !empty($path_info[2])) ? $path_info[2] : $method;  
		}

		$result = "class 不存在"; 
		
		if (class_exists($controller)) {
			$class = new $controller();
			$result = "method 不存在";
			if (method_exists($controller, $method)) {
				$result = $class->$method($request);
			}
		}

		$response->end($result);
	}

}
$server = new HttpServer();

// $http = new swoole_http_server("127.0.0.1", 9501);

// $http->on("start", function ($server) {
//     echo "Swoole http server is started at http://127.0.0.1:9501\n";
// });

// $http->on("request", function ($request, $response) {
//     $response->header("Content-Type", "text/plain");
//     $response->end("Hello World\n");
// });

// $http->start();
