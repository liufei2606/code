<?php

namespace ns\Testing;

use ns\Test as BaseTest;

class Test extends BaseTest
{
    public static function print()
    {
        printf("This is from son class print result %s".PHP_EOL, __CLASS__);
    }
}