<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class FirstTest extends TestCase
{
    public function testTrueAssertsToTrue()
    {
        $conditon = true;
        $this->assertTrue($conditon);
    }
}
