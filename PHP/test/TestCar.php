<?php

use PHPUnit\Framework\TestCase;

class TestCar extends TestCase
{
    public function testDrive(Car $car)
    {
        $car->drive();
    }

    public function testAddOil(AddOil $addOil)
    {
        $addOil->add();
    }
}


$lynkco = new LynkCo();
$testCar = new TestCar();

$testCar->testDrive($lynkco);
$testCar->testAddOil($lynkco);

echo "============================".PHP_EOL;
$battery = new Battery();
$lynk01 = new LynkCo01($battery);
$lynk01->drive();
echo "电力不足，自动切换为使用汽油作为动力来源...".PHP_EOL;
$gas = new Gas();
$lynkCo01 = new LynkCo01($gas);
$testCar->testDrive($lynkCo01);