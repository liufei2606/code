<?php

namespace Syntax\Oop;


class Child extends BaseChild
{
    public function __construct()
    {
        echo "Child constructor!", PHP_EOL;
    }

    public function foo()
    {
        echo "Child Foo!", PHP_EOL;
    }

    public function selfFoo()
    {
        return self::foo();
    }
}

$base = Child::getSelf();
$child = Child::getInstance();

$child->selfFoo();
$child->staticFoo();
$child->thisFoo();
