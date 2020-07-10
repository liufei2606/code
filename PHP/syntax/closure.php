<?php

class CRequest
{
    public array $routes = [];
    protected string $responseStatus = '200 OK';
    protected string $responseContentType = 'text/html';
    protected string $responseBody = 'Laravel学院';

    public function addRoute($routePath, $routeCallback): void
    {
        $this->routes[$routePath] = $routeCallback->bindTo($this, __CLASS__);
    }

    public function dispatch($currentPath): void
    {
        foreach ($this->routes as $routePath => $callback) {
            if ($routePath === $currentPath) {
                $callback();
            }
        }
        header('HTTP/1.1 '.$this->responseStatus);
        header('Content-Type: '.$this->responseContentType);
        header('Content-Length: '.mb_strlen($this->responseBody));
        echo $this->responseBody;
    }
}

$app = new CRequest();
$app->addRoute('user/nonfu', function () {
    $this->responseContentType = "application/json;charset=utf8";
    $this->responseBody = '{“name”:”LaravelAcademy"}';
});

$app->dispatch('user/nonfu');

# 匿名函数
$greet = function ($name) {
    return sprintf("Hello %s\r\n", $name);
};
echo $greet('LaravelAcademy.org');

# 回调
$numberPlusOne = array_map(function ($number) {
    return $number + 1;
}, [1, 2, 3]);
