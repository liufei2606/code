<?php
namespace Bar\subnamespace;

const FOO = 1;
function foo()
{
    echo 'function';
}
class foo
{
    public function __construct()
    {
        echo 'My class construct';
    }

    public static function staticmethod()
    {
        echo 'Static Method';
    }
}

// new foo();
// echo '<br>';
// new \Bar\subnamespace\foo();
// echo '<br>';
// foo();
// echo '<br>';
// \Bar\subnamespace\foo();
// echo '<br>';
// namespace\foo();

// echo '<br>';
// echo namespace\FOO;
// echo '<br>';
// echo FOO;
