<?php
namespace Syntax;

// Type 1: Simple callback
function my_callback_function()
{
    echo 'hello world!'."<br>";
}

call_user_func('my_callback_function');

// Type 2: Static class method call
class MyClass
{
    public static function myCallbackMethod()
    {
        echo 'Hello World!' . "<br>";
    }
}
call_user_func(array('MyClass', 'myCallbackMethod'));
call_user_func('MyClass::myCallbackMethod');

$obj = new MyClass();
call_user_func(array($obj, 'myCallbackMethod'));

class A
{
    public static function who()
    {
        echo "A\n<br>";
    }
}

class B extends A
{
    public static function who()
    {
        echo "B\n<br>";
    }
}
call_user_func(array('B', 'self::who')); // A

class c
{
    public function __invoke($name)
    {
        echo 'Hello ', $name, "\n";
    }
}
$c = new c();
call_user_func($c, "PHP!");

# closure
$double = function ($a) {
    return $a * 2;
};
$numbers = range(1, 5);
$new_numbers = array_map($double, $numbers);
print implode(' ', $new_numbers) . '<br>';

function foobar($arg, $arg2)
{
    echo __FUNCTION__, " got $arg and $arg2\n <br>";
}
class foo
{
    public function bar($arg, $arg2)
    {
        echo __METHOD__, " got $arg and $arg2\n";
    }
}

// Call the foobar() function with 2 arguments
call_user_func_array("foobar", array("one", "two"));

// Call the $foo->bar() method with 2 arguments
$foo = new foo;
call_user_func_array(array($foo, "bar"), array("three", "four"));

class Foo2
{
    public static function test($name)
    {
        print "Hello {$name}!\n<br>";
    }
}

// As of PHP 5.3.0
call_user_func_array(__NAMESPACE__ . 'Foo2::test', array('Hannes'));

// As of PHP 5.3.0
call_user_func_array(array(__NAMESPACE__ . 'Foo2', 'test'), array('Philip'));
