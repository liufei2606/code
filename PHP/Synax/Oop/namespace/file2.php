<?php
// namespace Bar;

include './demo1/file1.php';

use Bar\subnamespace;

const FOO = 3;
function foo()
{
}
class foo
{
    public static function staticmethod()
    {
    }
}

/* 非限定名称 */
foo(); // 解析为 Foo\Bar\foo resolves to function Foo\Bar\foo
foo::staticmethod(); // 解析为类 Foo\Bar\foo的静态方法staticmethod。resolves to class Foo\Bar\foo, method staticmethod
echo FOO; // resolves to constant Foo\Bar\FOO

/* 限定名称 */
subnamespace\foo(); // 解析为函数 Foo\Bar\subnamespace\foo
subnamespace\foo::staticmethod(); // 解析为类 Foo\Bar\subnamespace\foo,
                                  // 以及类的方法 staticmethod
echo subnamespace\FOO; // 解析为常量 Foo\Bar\subnamespace\FOO

/* 完全限定名称 */
\foo(); // 解析为函数 Foo\Bar\foo
\foo::staticmethod(); // 解析为类 Foo\Bar\foo, 以及类的方法 staticmethod
echo \FOO; // 解析为常量 Foo\Bar\FOO

\Bar\subnamespace\foo(); // 解析为函数 Foo\Bar\foo
\Bar\subnamespace\foo::staticmethod(); // 解析为类 Foo\Bar\foo, 以及类的方法 staticmethod
echo \Bar\subnamespace\FOO; // 解析为常量 Foo\Bar\FOO

