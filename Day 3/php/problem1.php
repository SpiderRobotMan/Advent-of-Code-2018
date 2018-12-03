<?php
$start = microtime(true);

$file = file_get_contents(__DIR__ . "/../input.txt");
$lines = explode("\n", trim($file));

$pattern = '/#(\d+) @ (\d+),(\d+): (\d+)x(\d+)/';

$spots = array();

foreach($lines as $line) {
	preg_match($pattern, $line, $groups);
	$id = $groups[1];
	$l_edge = (int) $groups[2];
	$t_edge = (int) $groups[3];
	$width = (int) $groups[4];
	$height = (int) $groups[5];
	
	for($i1 = $t_edge; $i1 < ($t_edge + $height); $i1++) {
		for($i2 = $l_edge; $i2 < ($l_edge + $width); $i2++) {
			$key = $i1 . "," . $i2;
			$spots[$key][$id] = $id;
		}
	}
}

$overlap = 0;
foreach($spots as $spot) {
	if(count($spot) > 1) $overlap++;
}

$end = microtime(true);

echo "Result: " . $overlap . "\n";
echo "Time to process: " . ($end - $start)*1000 . "ms";