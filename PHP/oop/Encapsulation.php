<?php

namespace Oop;

class Test
{
    private $foo;

    public function __construct($foo)
    {
        $this->foo = $foo;
    }

    public function baz(Test $other)
    {
        // We can change the private property:
        $other->foo = 'hello';
        var_dump($other->foo);

        // We can also call the private method:
        $other->bar();
    }

    private function bar()
    {
        echo 'Accessed the private method.';
    }
}

$test = new Test('test');
$test->baz(new Test('other'));

# 延迟绑定
class E
{
    public static $proPublic = "public of A";

    public function test()
    {
        echo "Class A:\n";
        echo self::$proPublic."\n";
        echo __CLASS__."\n";
        //echo parent::$proPublic."\n";
        self::myMethod();
        static::myMethod();
    }

    public function myMethod()
    {
        echo static::$proPublic."\n";
    }
}

class D extends E
{
    public static $proPublic = "public of B";

    public function test()
    {
        echo "\n\nClass B:\n";
        echo self::$proPublic."\n";
        echo __CLASS__."\n";
        echo parent::$proPublic."\n";
        self::myMethod();
        static::myMethod();
    }
}

class C extends D
{
    public static $proPublic = "public of C";
}

$t1 = new E();
$t1->test();
$t2 = new D();
$t2->test();
$t3 = new C();
$t3->test();