<?php


namespace Algorithms\Sort;

class Insertion extends AbstractSort
{
	public static function sort(array $arr)
	{
		if (!is_array($arr)) {
			return false;
		}
		$len = count($arr);
		if ($len <= 1) {
			return $arr;
		}
		for ($i = 1; $i < $len; $i++) {
			$j = $i - 1;
			$current = $arr[$i];
			// 循环不一样写法，思路一样，while 中可以叠加多个判断条件
			while ($j >= 0 && $arr[$j] > $current) {
				$arr[$j + 1] = $arr[$j];
				--$j;
			}
			$arr[$j + 1] = $current;
		}

		return $arr;
	}
}
