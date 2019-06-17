<?php

class Server
{
	private $serv ;
	public function __construct ()
	{
		$this->serv = new swoole_server( "0.0.0.0" ,9502 );
		$this->serv->set([ 'worker_num' => 2, 'task_worker_num' => 2, ]);
		$this->serv->on( 'Start' , function ($serv)
		{
			echo "SWOOLE:" . SWOOLE_VERSION . " 服务已启动" . PHP_EOL ;
			echo "SWOOLE_CPU_NUM:" . swoole_cpu_num (). PHP_EOL ;
			echo 'manager_pid:' . $serv->manager_pid . "\n";  //管理进程的PID，通过向管理进程发送SIGUSR1信号可实现柔性重启
			echo 'master_pid:' . $serv->master_pid . "\n";  //主进程的PID，通过向主进程发送SIGTERM信号可安全关闭服务器
			// var_dump($serv->connections); //当前服务器的客户端连接，可使用foreach遍历所有连接
			foreach ($serv->connections as $key => $value) {
				echo $value. "\n";
			}
		});
		$this->serv->on('request', function ($request, $response) {
			    if ($request->server['path_info'] == '/favicon.ico' || $request->server['request_uri'] == '/favicon.ico') {
					return $response->end();
				}

			var_dump($request->get, $request->post);
			$response->header("Content-Type", "text/html; charset=utf-8");
			$response->end("<h1>Hello Swoole. #".rand(1000, 9999)."</h1>");
		});

		$this->serv->on( 'Receive' , function( $serv ,$fd ,$from_id ,$data ){});
		$this->serv->on( 'Task' , function ( $serv , $task ){});
		$this->serv->on( 'Finish' , function ( $serv , $task_id , $data ){});
		$this->serv->start();
	}
}
$server = new Server();


