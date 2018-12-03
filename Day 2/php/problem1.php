<?php
$start = microtime(true);

$file = file_get_contents(__DIR__ . "/../input.txt");
$lines = explode("\n", trim($file));

$letters = ["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z"];

$two = 0;
$three = 0;

foreach($lines as $line) {
	$has_two = false;
	$has_three = false;
	foreach($letters as $letter) {
		$count = substr_count($line, $letter);
		if($count == 2) $has_two = true;
		if($count == 3) $has_three = true;
		if($has_two && $has_three) break;
	}
	
	if($has_two) $two++;
	if($has_three) $three++;
}

$end = microtime(true);

echo "Result: " . ($two * $three) . "\n";
echo "Time to process: " . ($end - $start)*1000 . "ms";