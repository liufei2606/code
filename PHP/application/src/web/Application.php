<?php

namespace sf\web;

class Application extends \sf\base\Application
{
    public function handleRequest()
    {
        $router = isset($_GET['r']) ? $_GET['r'] : '/';
        list($controllerName, $actionName) = explode('/', $router);

        if (!$controllerName || !$actionName) {
            return 'Hello world!';
        }
 
        $ucController = ucfirst($controllerName);
        $controllerNameAll = $this->controllerNamespace.'\\'.$ucController.'Controller';

        $controller = new $controllerNameAll;
        $controller->id = $controllerName;
        $controller->action = $actionName;

        return call_user_func([$controller, 'action'.ucfirst($actionName)]);
    }
}
