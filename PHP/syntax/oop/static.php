<?php

class Base
{
    public function __construct()
    {
        echo "Base constructor!", PHP_EOL;
    }

    public static function getSelf()
    {
        return new self();
    }

    public static function getInstance()
    {
        return new static();
    }

    public function selfFoo()
    {
        return self::foo();
    }

    public function staticFoo()
    {
        return static::foo();
    }

    public function thisFoo()
    {
        return $this->foo();
    }

    public function foo()
    {
        echo  "Base Foo!", PHP_EOL;
    }
}

class Child extends Base
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
