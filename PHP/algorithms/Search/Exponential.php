<?php


namespace Algorithms\Search;


class Exponential
{
	static function exponentialSearch(array $arr, int $key): int
	{
		$size = count($arr);
		if ($size == 0) {
			return -1;
		}
		$bound = 1;
		while ($bound < $size && $arr[$bound] < $key) {
			$bound *= 2;
		}

		return BinarySearch::binarySearch1($arr, $key, intval($bound / 2), min($bound, $size));
	}
}
