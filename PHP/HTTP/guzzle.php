<?php

require '../vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'on');

// $client = new GuzzleHttp\Client();

// $res = $client->request('GET', 'https://api.github.com/user', [
//     'auth' => ['name', 'pass&']
// ]);
// echo $res->getStatusCode(); // "200"
// echo $res->getHeader('content-type');  // 'application/json; charset=utf8'

$client = new Client([
    'base_uri' =>'http://httpbin.org',
    'timeout' =>2.0
]);
$response = $client->request('GET', 'get');
echo $response->getStatusCode() . "<br>";

$response = $client->delete('http://httpbin.org/delete');
echo $response->getStatusCode() . '<br>';
$response = $client->head('http://httpbin.org/get');
echo $response->getStatusCode() . '<br>';
$response = $client->options('http://httpbin.org/get');
echo $response->getStatusCode() . '<br>';
$response = $client->patch('http://httpbin.org/patch');
echo $response->getStatusCode() . '<br>';
$response = $client->post('http://httpbin.org/post');
echo $response->getStatusCode() . '<br>';
$response = $client->put('http://httpbin.org/put');
echo $response->getStatusCode() . '<br>';


$request = new Request('PUT', 'http://httpbin.org/put');
$response = $client->send($request, ['timeout' => 2]);
var_dump($response);
