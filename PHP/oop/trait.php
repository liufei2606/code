<?php

namespace Oop;

trait SayWorld
{
    public function sayHello()
    {
        parent::sayHello();
        echo 'World!';
    }
}

trait World
{
    public function sayWorld()
    {
        echo ' I am coming';
    }
}

class Base
{
    public function sayHi()
    {
        echo 'Hello ';
    }
}

class MyHelloWorld extends Base
{
    use SayHello, SayWorld;
}

$o = new MyHelloWorld();
$o->sayHi();
$o->sayHello();
$o->SayWorld();