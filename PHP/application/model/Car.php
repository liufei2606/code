<?php

namespace Application\services\Model;

class Car
{
    protected $engine;
    public static $name = '卡丁车';
    public static $model;
    public $color = 'red';
    public $address;

    const WIDTH = 2;
    const HEIGHT = 1.5;

    public function __construct(app\models\Engine $engine, $address)
    {
        $this->engine = $engine;
        $this->address = $address;
    }

    /**
     * dirve
     *
     * @return void
     */
    public function drive()
    {
    }

    public function fuel()
    {
    }
}
