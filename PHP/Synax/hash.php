<?php

function djbx33a($str)
{
    // hash(i) = hash(i-1) * 33 + str[i]
    $hash = 0;
	$s    = md5($str);
	echo $s . PHP_EOL;
    $seed = 5;
	$len  = 32;
    for ($i = 0; $i < $len; $i++) {
        // (hash << 5) + hash 相当于 hash * 33
        //$hash = sprintf("%u", $hash * 33) + ord($s{$i});
		//$hash = ($hash * 33 + ord($s{$i})) & 0x7FFFFFFF;

		$hash = ($hash << $seed) + ord($s{$i});
		// echo ($hash << $seed) + $hash + ord($s{$i});
		echo $s{$i} . '-' . ord($s{$i}) . '-' . $hash . PHP_EOL;
		if ($i ==3) {
			die;
		}
	}


    return $hash & 0x7FFFFFFF;
}

echo djbx33a('sagasgerq54wqtgfdagfdhrda').PHP_EOL;
// echo djbx33a('asdggdsfyreytrhjtrht').PHP_EOL;
// echo djbx33a('adfhgfhtrutkdjsfhfds57347*(^98').PHP_EOL;
