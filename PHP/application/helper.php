<?php

if (!function_exists('redirect')) {
	function redirect($route, $statusCode = 301)
	{
		$response = new \Application\services\Http\Response('', $statusCode, ['Location' => $route]);
		$response->send();
		exit();
	}
}
