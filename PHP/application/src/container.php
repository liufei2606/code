
# IOC 容器
<?php

/**
 * Class Container
 */
class Container
{
    /**
     * 容器内所管理的所有实例
     * @var array
     */
    protected $instances = [];

    /**
     * @param $class
     * @param null $concrete
     */
    public function set($class, $concrete = null)
    {
        if ($concrete === null) {
            $concrete = $class;
        }
        $this->instances[$class] = $concrete;
    }

    /**
     * 获取目标实例
     *
     * @param $class
     * @param array $param
     *
     * @return mixed|null|object
     * @throws Exception
     */
    public function get($class, ...$param)
    {
        // 如果容器中不存在则注册到容器
        if (!isset($this->instances[$class])) {
            $this->set($class);
        }
        //解决依赖并返回实例
        return $this->resolve($this->instances[$class], $param);
    }

    /**
     * 解决依赖
     *
     * @param $class
     * @param $param
     *
     * @return mixed|object
     * @throws ReflectionException
     * @throws Exception
     */
    public function resolve($class, $param)
    {
        if ($class instanceof Closure) {
            return $class($this, $param);
        }
        $reflector = new ReflectionClass($class);
        // 检查类是否可以实例化
        if (!$reflector->isInstantiable()) {
            throw new Exception("{$class} 不能被实例化");
        }
        // 通过反射获取到目标类的构造函数
        $constructor = $reflector->getConstructor();
        if (is_null($constructor)) {
            // 如果目标没有构造函数则直接返回实例化对象
            return $reflector->newInstance();
        }

        // 获取构造函数参数
        $parameters = $constructor->getParameters();
        //获取到构造函数中的依赖
        $dependencies = $this->getDependencies($parameters);
        // 解决掉所有依赖问题并返回实例
        return $reflector->newInstanceArgs($dependencies);
    }

    /**
     * 解决依赖关系
     *
     * @param $parameters
     *
     * @return array
     * @throws Exception
     */
    public function getDependencies($parameters)
    {
        $dependencies = [];
        foreach ($parameters as $parameter) {
            $dependency = $parameter->getClass();
            if ($dependency === null) {
                // 检查是否有默认值
                if ($parameter->isDefaultValueAvailable()) {
                    // 获取参数默认值
                    $dependencies[] = $parameter->getDefaultValue();
                } else {
                    throw new Exception("无法解析依赖关系 {$parameter->name}");
                }
            } else {
                // 重新调用get() 方法获取需要依赖的类到容器中。
                $dependencies[] = $this->get($dependency->name);
            }
        }

        return $dependencies;
    }
}
