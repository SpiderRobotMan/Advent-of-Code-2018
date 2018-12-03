<?php
$start = microtime(true);

$file = file_get_contents(__DIR__ . "/../input.txt");
$lines = explode("\n", trim($file));

$pattern = '/#(\d+) @ (\d+),(\d+): (\d+)x(\d+)/';

$spots = array();

foreach($lines as $line) {
	preg_match($pattern, $line, $groups);
	$id = $groups[1];
	$l_edge = (int) $groups[2]; // 849
	$t_edge = (int) $groups[3]; // 573
	$width = (int) $groups[4]; // 25
	$height = (int) $groups[5]; // 14
	
	for($i1 = $t_edge; $i1 < ($t_edge + $height); $i1++) {
		for($i2 = $l_edge; $i2 < ($l_edge + $width); $i2++) {
			$key = $i1 . "," . $i2;
			$spots[$key][$id] = $id;
		}
	}
}

$ids = array();
$occur_in_overlap = array();
foreach($spots as $spot) {
	$spot_count = count($spot);
	foreach($spot as $id) {
		$ids[$id] = $id;
		if($spot_count > 1) $occur_in_overlap[$id] = $id;
	}
}

$diff = array_diff($ids, $occur_in_overlap);

$end = microtime(true);

echo "Result: " . array_values($diff)[0] . "\n";
echo "Time to process: " . ($end - $start)*1000 . "ms";