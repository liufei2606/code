<?php
namespace syntax\oop;

trait PowerTrait
{
    protected $power;

    protected function gas()
    {
        $this->power = '汽油';
    }

    public function battery()
    {
        $this->power = '电池';
    }

    private function water()
    {
        $this->power = '水';
    }

    public function print()
    {
        echo "动力来源：".$this->power.PHP_EOL;
    }
}