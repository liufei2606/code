<?php
    //dog_naive.php

class dog
{
    public $name = "";
    public function setName($name)
    {
        $this->name = $name;
    }
    public function getName()
    {
        return $this->name;
    }
}

$rover = new dog();
        //通过Getter/Setter方式
for ($x = 0; $x < 10; $x++) {
    $t = microtime(true);
    for ($i = 0; $i < 1000000; $i++) {
        $rover->setName("rover");
        $n = $rover->getName();
    }
    echo microtime(true) - $t;
    echo "\n";
}
        //直接存取变量方式
for ($x = 0; $x < 10; $x++) {
    $t = microtime(true);
    for ($i = 0; $i < 1000000; $i++) {
        $rover->name = "rover";
        $n = $rover->name;
    }
    echo microtime(true) - $t;
    echo "\n";
}
