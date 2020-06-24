<?php

class myIterator implements Iterator
{
    private $position = 0;
    private $array = array(
        "firstelement",
        "secondelement",
        "lastelement",
    );

    public function __construct()
    {
        $this->position = 0;
    }

    public function rewind()
    {
        echo __METHOD__.PHP_EOL;
        $this->position = 0;
    }

    public function current()
    {
        echo __METHOD__.PHP_EOL;
        return $this->array[$this->position];
    }

    public function key()
    {
        echo __METHOD__.PHP_EOL;
        return $this->position;
    }

    public function next()
    {
        echo __METHOD__.PHP_EOL;
        ++$this->position;
    }

    public function valid()
    {
        echo __METHOD__.PHP_EOL;
        return isset($this->array[$this->position]);
    }
}

$it = new myIterator;
foreach ($it as $key => $value) {
    echo $key.'@@'.$value.PHP_EOL;
}
