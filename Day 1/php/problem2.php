<?php
$start = microtime(true);

$frequency = 0;
$seen = [];
$first = null;

$file = file_get_contents(__DIR__ . "/../input.txt");
$lines = explode("\n", trim($file));

$loops = 0;
while($first == null) {
	$loops += 1;
	foreach($lines as $line) {
		$frequency += (int)$line;
		if(isset($seen[$frequency])) {
			$first = $frequency;
			break;
		}
		$seen[$frequency] = $frequency;
	}
}

$end = microtime(true);

echo "Result: " . $first . "\n";
echo "Loops: " . $loops . "\n";
echo "Frequencies seen: " . count($seen) . "\n";
echo "Time to process: " . ($end - $start)*1000 . "ms";