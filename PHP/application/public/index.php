<?php
require_once __DIR__.'/../../vendor/autoload.php';
$container = require __DIR__.'/../bootstrap.php';

$request = (new Application\services\Http\Request)->capture();
$container->bind('request', $request);

$router = require __DIR__.'/../routes/web.php';

$router->dispatch($request);
