<?php

$requestBody = '{"username":"nonfu"}';
$context = stream_context_create([
	'http' => [
		'method' => 'POST',
		'header' => "Content-Type: application/json;charset=utf-8;\r\nContent-Length: ".mb_strlen($requestBody),
		'content' => $requestBody
	]
]);
$response = file_get_contents('https://my-api.com/users', false, $context);
