<?php

namespace app\models;

class Car {

protected $engine;
public static $name = '卡丁车';
public static $model;
public $color = 'red';

const WIDTH = 2;
const HEIGHT = 1.5;

public function __construct(app\models\Engine $engine)
{
	$this->engine = $engine;
}
/**
 * dirve
 *
 * @return void
 */
public function drive(){}
public function fuel(){}
}
