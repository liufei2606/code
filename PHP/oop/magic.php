<?php

namespace Oop;

//class CallableClass
//{
//    function __invoke($x) {
//        var_dump($x);
//    }
//}
//$obj = new CallableClass;
//$obj(5);
//var_dump(is_callable($obj));
//
//function __call($function, $args){
//    array_unshift($args, $this->value);
//    $this->value = call_user_func_array($function, $args);
//    return $this;
//}
//
//function __call($function, $args){
//    $this->value = call_user_func($function, $this->value, $args[0]);
//    return $this;
//}
<?php
namespace Syntax\Oop;

class Magic
{
    protected $brand;
    private $no;
    public $engine = 'Moto';
    protected $data = [];

    public static $WHEELS = 4;

    /**
     * @return mixed
     */
    public function getBrand()
    {
        return $this->brand;
    }

    public function getNo()
    {
        return $this->no;
    }

    /**
     * @param  mixed  $brand
     */
    public function setBrand($brand): void
    {
        $this->brand = $brand;
    }

    public function __sleep()
    {
        return ['brand', 'no', 'engine'];
    }

    public function __wakeup()
    {
        $this->no = 10001;
    }

    public function __call($name, $arguments)
    {
        echo "调用的成员方法不存在".PHP_EOL;
    }

    public static function __callStatic($name, $arguments)
    {
        echo "调用的静态方法不存在".PHP_EOL;
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        return $this->data[$name];
    }

    public function __invoke($brand)
    {
        $this->brand = $brand;
        echo "蓝天白云，定会如期而至 -- ".$this->brand.PHP_EOL;
    }
}

$car = new Magic();
$car->setBrand("领克01");

## __set __get
$car->engine = 'Audi';
echo "发动机品牌：".$car->engine.PHP_EOL;
$car->name = "林肯";
echo "汽车名字：".$car->name.PHP_EOL;

## 序列化
$string = serialize($car);
file_put_contexts("car", $string);
$context = file_get_contexts("car");
$object = unserialize($context);
echo "汽车品牌：".$object->getBrand().PHP_EOL;
echo "汽车No.：".$object->getNo().PHP_EOL;

## __call
$object->drive();
Magic::drive();

$object->name = "林肯";
echo "汽车名字：".$object->name.PHP_EOL;

$car('BWM');

## cpoy
$carA = new stdClass();
$carA->brand = '奔驰';

//$carB = $carA;
$carB = clone $carA;
$carB->brand = '宝马';

var_dump($carA);
var_dump($carB);

## deep copy
class Engine
{
}

class Car
{
    public $brand;
    /**
     * @var Engine
     */
    public $engine;

    public function __clone()
    {
        $this->engine = clone $this->engine;
    }
}

$benz = new Car();
$benz->brand = '奔驰';
$engine = new Engine();
$benz->engine = $engine;

$lnykco02 = clone $benz;
$lnykco02->brand = '领克02';
$lnykco02->engine->num = 3;

var_dump($benz);
var_dump($lnykco02);
