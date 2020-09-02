<?php


namespace Tests;

use PHPUnit\Framework\TestCase;

class DependencyTest extends TestCase
{
    public function test1()
    {
        $this->assertTrue(true);
        return 1;
    }

    public function test2()
    {
        $this->assertTrue(true);
        return 2;
    }

    public function test3()
    {
        $this->assertTrue(true);
        return 3;
    }

    /**
     * @param $arg1
     * @param $arg2
     * @param $arg3
     *
     * @depends test1
     * @depends test2
     * @depends test3
     */
    public function testDependccies($arg1, $arg2, $arg3)
    {
        $this->assertEquals(1, $arg1);
        $this->assertEquals(2, $arg2);
        $this->assertEquals(3, $arg3);
    }

    public function testCreateStdClass()
    {
        $obj = new \stdClass();
        $obj->foo = 'bar';
        $this->assertTrue(true);
        return $obj;
    }

    /**
     * @depends testCreateStdClass
     */
    public function testDepency1($obj)
    {
        $this->assertEquals('bar', $obj->foo);
        $obj->foo = 'notbar';
    }

    /**
     * @depends testCreateStdClass
     */
    public function testDepency2($obj)
    {
        $this->assertEquals('notbar', $obj->foo);
    }
}
