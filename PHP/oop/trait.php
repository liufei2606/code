<?php

namespace Syntax\oop;

class Base
{
    public function sayHi()
    {
        echo 'Hello ';
    }
}

trait SayWorld
{
    public function sayHello()
    {
        parent::sayHello();
        echo 'World!';
    }
}

trait World {
    public function sayWorld() {
        echo ' I am coming';
    }
}

class MyHelloWorld extends Base {
    use SayHello, SayWorld;
}

$o = new MyHelloWorld();
$o->sayHi();
$o->sayHello();
$o->SayWorld();