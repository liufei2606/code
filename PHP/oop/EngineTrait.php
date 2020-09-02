<?php

namespace Oop;

trait EngineTrait
{
    protected $engine;

    static public function print()
    {
        echo "发动机个数：".$this->engine.PHP_EOL;
    }

    protected function three()
    {
        $this->engine = 3;
    }

    protected function four()
    {
        $this->engine = 4;
    }
}