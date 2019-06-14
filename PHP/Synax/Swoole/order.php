<?php
/**
 * 顺序执行
 */

function test1() {
	sleep(1);
	echo "b";
}

function test2() {
	sleep(2);
	echo "c";
}

test1();
test2();
echo "\n";
