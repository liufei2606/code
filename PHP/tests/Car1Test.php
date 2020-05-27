<?php


use PHPUnit\Framework\TestCase;

class Car1Test extends TestCase
{

    public function testDrive(Car1 $car)
    {
        $car->drive();
    }
}
