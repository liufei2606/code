<?php

use PHPUnit\Framework\TestCase;

class ExceptionTest extends TestCase
{
	public function testException()
    {
		$this->expectException(InvalidArgumentException::class);
		$this->expectException(InvalidArgumentException::class);
    }

	public function testFailingInclude()
    {
		$this->expectException(PHPUnit\Framework\Error::class);
		include 'not_existing_file.php';
    }
}

?>
