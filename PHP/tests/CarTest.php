<?php

use PHPUnit\Framework\TestCase;

class CarTest extends TestCase
{
    public function testDrive(\syntax\oop\Car $car)
    {
        $car->drive();
    }

    public function testAddOil(\syntax\oop\AddOil $addOil)
    {
        $addOil->add();
    }
}


$lynkco = new \syntax\oop\LynkCo();
$testCar = new CarTest();

$testCar->testDrive($lynkco);
$testCar->testAddOil($lynkco);

echo "============================".PHP_EOL;
$battery = new \syntax\oop\Battery();
$lynk01 = new \syntax\oop\LynkCo01($battery);
$lynk01->drive();
echo "电力不足，自动切换为使用汽油作为动力来源...".PHP_EOL;
$gas = new \syntax\oop\Gas();
$lynkCo01 = new \syntax\oop\LynkCo01($gas);
$testCar->testDrive($lynkCo01);