<?php

require '../vendor/autoload.php';

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'on');

$client = new GuzzleHttp\Client();

$res = $client->request('GET', 'https://api.github.com/user', [
    'auth' => ['name', 'pass&']
]);
echo $res->getStatusCode(); // "200"
echo $res->getHeader('content-type');  // 'application/json; charset=utf8'
