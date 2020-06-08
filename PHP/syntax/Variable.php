<?php

# 以 $ 开头
#　$ 之后具体的变量名只支持字母（支持中文字符，不过尽量使用 ASCII 字符，以免出现意想不到的问题）、数字、下划线，并且不能以数字开头
$foo = 'Bob';
echo $foo.PHP_EOL;
printf("%s\n", $foo);

# 对象引用:指向同一个地址，一起改变
$bar = &$foo;
$bar = "My name is $bar";
echo $bar.PHP_EOL;
$foo = 'Henry';
echo $bar.PHP_EOL;
$bar = "Sam";
echo $foo.PHP_EOL;

## 可变变量
$greeting = "你好";
$varName = "greeting";
echo $$varName;

## 常量
define("LANGUAGE", "PHP");
const FRAMEWORK = "Laravel";

# 变量
$variablename = value;

$x=5;
$y=10;
function myTest()
{
    global $x,$y;
    $y=$x+$y;
    echo $y;
}
myTest(); // 15

function myTest()
{
    static $x=0;
    echo $x;
    $x++;
}
myTest(); // 0
myTest(); // 1
myTest(); // 2

function myTest($x)
{
    echo $x;
}
myTest(5); # 5

// 函数内销毁全局变量$foo是无效的,应使用 $GLOBALS 数组来实现
function destroy_foo() {
    global $foo;
    // unset($foo);
    unset($GLOBALS['bar']);
    echo $foo;//Notice: Undefined variable: foo
}
$foo = 'bar';
destroy_foo();
echo $foo;//bar

# 常量
define("MESSAGE", "Hello YiiBai PHP");
const MESSAGE = "Hello const by YiiBai PHP";

require('./ShopProduct.php'); # 加载文件

# __clone实现真正深拷贝
class Test{
    public $a=1;
}

class TestOne{
    public $b=1;
    public $obj;
    //包含了一个对象属性，clone时，它会是浅拷贝
    public function __construct(){
        $this->obj = new Test();
    }

    //  方法一 重写clone函数
    public function __clone(){
        $this->obj = clone $this->obj;
    }
}

$m = new TestOne();

//方法二，序列化反序列化实现对象深拷贝
$n = serialize($m);
$n = unserialize($n);

$n->b = 2;
echo $m->b;//输出原来的1
echo PHP_EOL;
//普通属性实现了深拷贝，改变普通属性b，不会对源对象有影响
$n->obj->a = 3;
echo $m->obj->a;//输出1，不随新对象改变，还是保持了原来的属性,可以看到，序列化和反序列化可以实现对象的深拷贝