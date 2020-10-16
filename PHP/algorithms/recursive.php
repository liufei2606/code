<?php

function factorial(int $n): int
{
	if ($n == 0) {
		return 1;
	}
	return $n * factorial($n - 1);
}

function factorialByIterative(int $n): int
{
	$result = 1;
	for ($i = $n; $i > 0; $i--) {
		$result *= $i;
	}
	return $result;
}

echo factorial(5).PHP_EOL;
echo factorialByIterative(5).PHP_EOL;

// greatest common division
function gcd(int $a, int $b): int
{
	if ($b == 0) {
		return $a;
	} else {
		return gcd($b, $a % $b);
	}
}

echo gcd(24, 15);
