<?php

namespace Application\services\Http;

class Request extends \Symfony\Component\HttpFoundation\Request
{
    public function capture()
    {
        static::enableHttpMethodParameterOverride();
        return static::createFromGlobals();
    }

    public function getPath()
    {
        $path = trim($this->getPathInfo(), '/');
        return $path == '' ? '/' : $path;
    }
}
