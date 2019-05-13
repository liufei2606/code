<?php

function gen()
{
	echo "hello gen" . PHP_EOL . "\r\n";//step1
	$ret = (yield "gen1");   //step2
	echo $ret . "\n";  //step3
	$ret = (yield "gen2");   //step4
	echo $ret . "\n";  //step3
}

$my_gen = gen();
echo $my_gen->current();
echo $my_gen->send("main send");

function xrange($start, $limit, $step = 1)
{
	if ($start < $limit) {
		if ($step <= 0) {
			throw new LogicException('Step must be +ve');
		}

		for ($i = $start; $i <= $limit; $i += $step) {
			yield $i;
		}
	} else {
		if ($step >= 0) {
			throw new LogicException('Step must be -ve');
		}

		for ($i = $start; $i >= $limit; $i += $step) {
			yield $i;
		}
	}
}

echo 'Single digit odd numbers from range():  ';
foreach (range(1, 9, 2) as $number) {
	echo "$number ";
}
echo "\n";

echo 'Single digit odd numbers from xrange(): ';

foreach (xrange(1, 9, 2) as $number) {
	echo "$number ";
}

