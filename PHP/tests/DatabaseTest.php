<?php

namespace Test;

use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{
    protected static $dbh;

    public static function setUpBeforeClass():void
    {
        self::$dbh = new \PDO('sqlite::memory:');
    }

    public function testtSomthing()
    {
        $this->markTestIncomplete('something new');
    }

    public static function tearDownAfterClass():void
    {
        self::$dbh = null;
    }
}
