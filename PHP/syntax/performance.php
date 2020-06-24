<?php

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

# Getter/Setter方式 vs 存取变量方式:前者比后者打一个数量级
$rover = new dog();

for ($x = 0; $x < 10; $x++) {
    $t = microtime(true);
    for ($i = 0; $i < 1000000; $i++) {
        $rover->setName("rover");
        $n = $rover->getName();
    }
    echo microtime(true) - $t;
    echo "\n";
}
//直接
for ($x = 0; $x < 10; $x++) {
    $t = microtime(true);
    for ($i = 0; $i < 1000000; $i++) {
        $rover->name = "rover";
        $n = $rover->name;
    }
    echo microtime(true) - $t;
    echo "\n";
}

$startMemory = memory_get_usage();
$array = range(1, 100000);
echo memory_get_usage() - $startMemory, ' bytes';
