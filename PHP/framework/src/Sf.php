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
			if (null === $parameter->getClass()) {
				return $this->processNoHinted($parameter);
			}else{
				return $this->processHinted($parameter);
			}
		}, $patameters);

		return $reflector->newInstanceArgs($dependencies);
	}

	protected function processNoHinted(\ReflectionParameter $parameter){
		if ($parameter->isDefaultValueAvailable()) {
			return $parameter->getName();
		}else{
			throw new \Exception($parameter->getName() . '不能为空', 1);
		}
	}

	protected function processHinted($parameter){
		return $this->getInstance($parameter->get_class()->getName());
	}
}
