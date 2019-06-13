<?php

use Swoole\Coroutine\Channel;

/**
 *
 */
class SwooleController
{

	public function home($request){
		$get = isset($request->get) ? $request->get : [];
		$result = '<h1> 你好</h1>　<br>，ＧＥＴ参数：'. json_encode($get);

		return $result;
	}

	public function login($request){
		$get = isset($request->get) ? $request->get : [];
		$result = '登录成功';

		return $result;
    }

	public function channel() {
		go(function () {
			//创建十个信箱通道
			$mailBoxes = [];
			for ($i = 1;$i <= 10;$i++) {
				$mailBoxes[$i] = new Channel(16);
			}
			//模拟master 邮局调度,随机像一个信箱投递消息
			go(function () use ($mailBoxes) {
				while (1) {
					\co::sleep(2);
					$key = rand(1, 10);
					($mailBoxes[$key])->push(time());
				}
			});
			//模拟actor 实体消费
			for ($i = 1;$i <= 10; $i++) {
				go(function () use ($mailBoxes,$i) {
					while (1) {
						$msg = ($mailBoxes[$i])->pop();
						echo "Actor {$i} recv msg : {$msg} \n";
					}
				});
			}
		});

	}
}

$instance = new SwooleController();
$instance->channel();


