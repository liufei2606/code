<?php


abstract class BaseCar implements CarContract
{
    protected $brand;

    public function __construct($brand)
    {
        $this->brand = $brand;
    }

    abstract public function drive();
}