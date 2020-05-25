<?php


class LynkCo01 extends BaseCar implements CarContract
{

    public function __construct()
    {
        $this->brand = '领克01';
        parent::__construct($this->brand);
    }

    public function drive()
    {
        echo "启动{$this->brand}汽车".PHP_EOL;
    }
}