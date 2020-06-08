<?php

class A {
    public static function who() {
        echo __CLASS__;
    }
    public static function test() {
        self::who();
    }
}

class B extends A {
    public static function who() {
        echo __CLASS__;
    }
}

B::test(); # A

class Base {
    public function __construct() {
        echo "Base constructor!", PHP_EOL;
    }

    public static function getSelf() {
        return new self();
    }

    public static function getInstance() {
        return new static();
    }

    public function selfFoo() {
        return self::foo();
    }

    public function staticFoo() {
        return static::foo();
    }

    public function thisFoo() {
        return $this->foo();
    }

    public function foo() {
        echo  "Base Foo!", PHP_EOL;
    }
}

class Child extends Base {
    public function __construct() {
        echo "Child constructor!", PHP_EOL;
    }

    public function foo() {
        echo "Child Foo!", PHP_EOL;
    }
}

$base = Child::getSelf();
$child = Child::getInstance();

$child->selfFoo();
$child->staticFoo();
$child->thisFoo();
// Base constructor!
// Child constructor!
// Base Foo!
// Child Foo!
// Child Foo!