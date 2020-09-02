<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class MultipleDependenciesTest extends TestCase
{
    public function provider()
    {
        return [['provider1', 'provider2']];
    }

    public function testProducerOne()
    {
        $this->assertTrue(true);
        return 'First';
    }

    public function testProducerTwo()
    {
        $this->assertTrue(true);
        return 'Two';
    }

    /**
     * @depends      testProducerOne
     * @depends      testProducerTwo
     * @dataProvider provider
     */
    public function testConsumer()
    {
        $this->assertEquals(['provider1', 'provider2', 'First', 'Two'], func_get_args());
    }
}
