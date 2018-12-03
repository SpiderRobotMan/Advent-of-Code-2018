<?php
$start = microtime(true);

$file = file_get_contents(__DIR__ . "/../input.txt");
$lines = explode("\n", trim($file));

$diff_index = 0;
$diff_line = "";

$line_count = count($lines);

for($i1 = 0; $i1 < $line_count; $i1++) {
	$line1 = $lines[$i1];
	
	for($i2 = $i1+1; $i2 < $line_count; $i2++) {
		$line2 = $lines[$i2];
		
		$diffs = 0;
		
		for($i = 0; $i < 26; $i++) {
			$char1 = $line1[$i];
			$char2 = $line2[$i];
			if($char1 != $char2) {
				if($diffs >= 1) break;
				$diffs++;
				$diff_index = $i;
			}
		}
		if($diffs == 1) {
			$diff_line = $line1;
			break;
		}
	}
}

$end = microtime(true);

echo "Result: " . substr_replace($diff_line, "", $diff_index, 1) . "\n";
echo "Time to process: " . ($end - $start)*1000 . "ms";

/*
foreach($lines as $line1) {
	foreach($lines as $line2) {
		$diffs = 0;
		
		for($i = 0; $i < 26; $i++) {
			$char1 = $line1[$i];
			$char2 = $line2[$i];
			if($char1 != $char2) {
				if($diffs >= 1) break;
				$diffs++;
				$diff_index = $i;
			}
		}
		if($diffs == 1) {
			$diff_line = $line1;
			break;
		}
	}
}
*/