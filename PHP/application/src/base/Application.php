<?php
namespace sf\base;

use Exception;

abstract class Application
{
    public $controllerNamespace = 'app\\controller';

    public function run()
    {
        try {
            return $this->handleRequest();
        } catch (Exception $e) {
            return $e;
        }
    }

    abstract public function handleRequest();
}
