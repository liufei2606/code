<?php


namespace DesignPatterns\Structural\Bridge;


class Produce implements Workshop
{
	public function work()
	{
		print 'Produced ';
	}
}
