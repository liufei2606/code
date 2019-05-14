<?php

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
		$result = '登录成功'.;

		return $result;
	}

}