<?php

/**
 * Class Point
 */
class Point
{
    public $x;
    public $y;

    /**
     * Point constructor.
     * @param int $x  horizontal value of point's coordinate
     * @param int $y  vertical value of point's coordinate
     */
    public function __construct($x = 0, $y = 0)
    {
        $this->x = $x;
        $this->y = $y;
    }
}


class Circle
{
    /**
     * @var int
     */
    public $radius;//半径

    /**
     * @var Point
     */
    public $center;//圆心点

    const PI = 3.14;

    public function __construct(Point $point, $radius = 1)
    {
        $this->center = $point;
        $this->radius = $radius;
    }

    //打印圆点的坐标
    public function printCenter()
    {
        printf('center coordinate is (%d, %d)', $this->center->x, $this->center->y);
    }

    //计算圆形的面积
    public function area()
    {
        return self::PI * pow($this->radius, 2);
    }
}


$reflectionClass = new ReflectionClass(Circle::class);
var_dump($reflectionClass);
var_dump($reflectionClass->getConstants());
var_dump($reflectionClass->getProperties());
var_dump($reflectionClass->getMethods());
var_dump($reflectionClass->getConstructor());
var_dump($reflectionClass->getConstructor()->getParameters());

//构建类的对象
function make($className)
{
    $reflectionClass = new ReflectionClass($className);
    $constructor = $reflectionClass->getConstructor();
    $parameters  = $constructor->getParameters();
    $dependencies = getDependencies($parameters);

    return $reflectionClass->newInstanceArgs($dependencies);
}

//依赖解析
function getDependencies($parameters)
{
    $dependencies = [];
    foreach ($parameters as $parameter) {
        $dependency = $parameter->getClass();
        if (is_null($dependency)) {
            if ($parameter->isDefaultValueAvailable()) {
                $dependencies[] = $parameter->getDefaultValue();
            } else {
                //不是可选参数的为了简单直接赋值为字符串0
                //针对构造方法的必须参数这个情况
                //laravel是通过service provider注册closure到IocContainer,
                //在closure里可以通过return new Class($param1, $param2)来返回类的实例
                //然后在make时回调这个closure即可解析出对象
                //具体细节我会在另一篇文章里面描述
                $dependencies[] = '0';
            }
        } else {
            //递归解析出依赖类的对象
            $dependencies[] = make($parameter->getClass()->name);
        }
    }

    return $dependencies;
}

$circle = make('Circle');
$area = $circle->area();

# 利用反射机制创建实例
$reflector = new reflectionClass(User::class);
$constructor = $reflector->getConstructor();
$dependencies = $constructor->getParameters();
$user = $reflector->newInstanceArgs($dependencies = []);