<?php
$start = microtime(true);

$file = file_get_contents(__DIR__ . "/../input.txt");

function react($line) {
	$letters = str_split("abcdefghijklmnopqrstuvwxyz");
	
	$found = true;
	while($found) {
		$match = false;
		foreach($letters as $letter) {
			$line = str_replace(strtolower($letter) . strtoupper($letter), "", $line, $count1);
			if($count1 > 0) $match = true;
			
			$line = str_replace(strtoupper($letter) . strtolower($letter), "", $line, $count2);
			if($count2 > 0) $match = true;
		}
		
		$found = $match;
	}
	
	return $line;
}

$result = strlen(react($file));

$end = microtime(true);

echo "Result: " . $result . "\n";
echo "Time to process: " . ($end - $start)*1000 . "ms";