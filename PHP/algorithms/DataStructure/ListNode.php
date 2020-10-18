<?php

namespace Algorithms\DataStructure;

class ListNode
{
	public $data = null;
	public $next = null;

	public function __construct(string $data = null)
	{
		$this->data = $data;
	}
}
