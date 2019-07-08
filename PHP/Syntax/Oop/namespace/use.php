<?php
namespace Bar;

include './declare.php';

// use Bar\subnamespace;

const FOO = 3;
function foo()
{
	echo 'self funtion'. '<br>';
}
class foo
{
    public static function staticmethod()
    {
		echo 'self static method'. '<br>';
    }
}

/* 非限定名称 */
foo(); // 解析为 Foo\Bar\foo resolves to function Foo\Bar\foo
foo::staticmethod(); // 解析为类 Foo\Bar\foo的静态方法staticmethod。resolves to class Foo\Bar\foo, method staticmethod
echo FOO; // resolves to constant Foo\Bar\FOO
echo namespace\FOO;
echo __NAMESPACE__ .'\FOO';
echo '<br>';

/* 限定名称 */
subnamespace\foo(); // 解析为函数 Foo\Bar\subnamespace\foo
echo '<br>';
subnamespace\foo::staticmethod(); // 解析为类 Foo\Bar\subnamespace\foo,
echo '<br>';
echo subnamespace\FOO; // 解析为常量 Foo\Bar\subnamespace\FOO
echo '<br>';

/* 完全限定名称 */
\Bar\foo(); // 解析为函数 Bar\foo
\Bar\foo::staticmethod(); // 解析为类 Foo\Bar\foo, 以及类的方法 staticmethod
echo \Bar\FOO; // 解析为常量 Foo\Bar\FOO

echo '<br>';
\Bar\subnamespace\foo(); // 解析为函数 Foo\Bar\foo
\Bar\subnamespace\foo::staticmethod(); // 解析为类 Foo\Bar\foo, 以及类的方法 staticmethod
echo \Bar\subnamespace\FOO; // 解析为常量 Foo\Bar\FOO
