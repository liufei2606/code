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
$lynkCo01 = new LynkCo01();
$testCar = new TestCar();

$testCar->testDrive($lynkco);
$testCar->testAddOil($lynkco);
echo "============================".PHP_EOL;
$testCar->testDrive($lynkCo01);