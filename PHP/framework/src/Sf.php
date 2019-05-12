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

	public function getInstance($className){
		$reflector = new \ReflectionClass($className);
		if (!$reflector->isInstantiable()) {
			return false;
		}

		$constructor = $reflector->getConstructor();
		if (!$constructor) {
			return new $className;
		}

		$patameters = $constructor->getParameters();
		$dependencies = array_map(function($parameter) {
			return $this->getInstance($parameter->get_class()->getName());
		}, $patameters);

		return $reflector->newInstanceArgs($dependencies);
	}
}
