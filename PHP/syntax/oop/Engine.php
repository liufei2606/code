<?php


trait Engine
{
    protected $engine;

    protected function three()
    {
        $this->engine = 3;
    }

    protected function four()
    {
        $this->engine = 4;
    }

    public function print()
    {
        echo "发动机个数：".$this->engine.PHP_EOL;
    }
}