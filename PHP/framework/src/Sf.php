<?php

class Sf
{
    public static function createObject($name)
    {
        $config = require(SF_PATH . "/config/$name.php");

        $instance = new $config['class']();
        unset($config['class']);

        foreach ($config as $key => $value) {
            $instance->$key = $value;
        }

        $instance->init();

        return $instance;
    }
}
