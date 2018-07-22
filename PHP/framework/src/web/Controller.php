<?php

namespace sf\web;

use sf\view\Compiler;

class Controller extends \sf\base\Controller
{
    // public function render($view, $params = [])
    // {
    //     extract($params);
    //     return require '../views/' . $view . '.php';
    // }
    public function render($view, $params = [])
    {
        (new Compiler())->compile($view, $params);
    }

    public function toJson($data)
    {
        if (is_string($data)) {
            return $data;
        }

        return json_encode($data);
    }
}
