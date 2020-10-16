<?php

$items = 100000;

$startMemory = memory_get_usage();
$array = new SplFixedArray($items);
for ($i = 0; $i < $items; $i++) {
	$array[$i] = $i*10;
}
$endMemory = memory_get_usage();

$memoryConsumed = ($endMemory - $startMemory) / (1024 * 1024);
$memoryConsumed = ceil($memoryConsumed);
echo "memory = {$memoryConsumed} MB\n";

$newArray = $array->toArray();

$BookTitles = new SplDoublyLinkedList();

$BookTitles->push("Introduction to Algorithm");
$BookTitles->push("Introduction to PHP and Data structures");
$BookTitles->push("Programming Intelligence");
$BookTitles->push("Mediawiki Administrative tutorial guide");
$BookTitles->add(1,"Introduction to Calculus");
$BookTitles->add(3,"Introduction to Graph Theory");

for($BookTitles->rewind();$BookTitles->valid();$BookTitles->next()){
	echo $BookTitles->current()."\n";
}

$books = new SplStack();
$books->push("Introduction to PHP7");
$books->push("Mastering JavaScript");
$books->push("MySQL Workbench tutorial");
echo $books->pop() . "\n";
echo $books->top() . "\n";

function expressionChecker(string $expression): bool {
	$valid = TRUE;
	$stack = new SplStack();

	for ($i = 0; $i < strlen($expression); $i++) {
		$char = substr($expression, $i, 1);

		switch ($char) {
			case '(':
			case '{':
			case '[':
				$stack->push($char);
				break;

			case ')':
			case '}':
			case ']':
				if ($stack->isEmpty()) {
					$valid = FALSE;
				} else {
					$last = $stack->pop();
					if (($char == ")" && $last != "(")
						|| ($char == "}" && $last != "{")
						|| ($char == "]" && $last != "[")) {

						$valid = FALSE;
					}
				}
				break;
		}

		if (!$valid)
			break;
	}

	if (!$stack->isEmpty()) {
		$valid = FALSE;
	}

	return $valid;
}

$expressions = [];
$expressions[] = "8 * (9 -2) + { (4 * 5) / ( 2 * 2) }";
$expressions[] = "5 * 8 * 9 / ( 3 * 2 ) )";
$expressions[] = "[{ (2 * 7) + ( 15 - 3) ]";

foreach ($expressions as $expression) {
	$valid = expressionChecker($expression);

	if ($valid) {
		echo "Expression is valid \n";
	} else {
		echo "Expression is not valid \n";
	}
}
