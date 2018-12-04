<?php
$start = microtime(true);

$file = file_get_contents(__DIR__ . "/../input.txt");
$lines = explode("\n", trim($file));

$pattern = "/\[(.*)\] (.*)/";

$sorted = array();

foreach($lines as $line) {
	preg_match($pattern, $line, $groups);
	
	$time = strtotime($groups[1]);
	
	$sorted[$time] = array(
		"time" => $groups[1],
		"string" => $groups[2]
	);
}

ksort($sorted);

$slept_time = array();
$guards = array();

$sleep_start = 0;
$current_guard = 0;

$guard_pattern = "/Guard #(\d+) begins shift/";
$time_pattern = "/(\d+)-(\d+)-(\d+) (\d+):(\d+)/";

foreach($sorted as $key=>$value) {
	if($value["string"] == "falls asleep") {
		preg_match($time_pattern, $value["time"], $groups);
		$sleep_start = (int) $groups[5];
	} else if($value["string"] == "wakes up") {
		preg_match($time_pattern, $value["time"], $groups);
		$sleep_end = (int) $groups[5];
		
		for($i=$sleep_start; $i < $sleep_end; $i++) {
			if(!isset($guards[$current_guard][$i])) $guards[$current_guard][$i] = 0;
			$guards[$current_guard][$i] += 1;
		}
		$sleep_start = 0;
	} else {
		preg_match($guard_pattern, $value["string"], $groups);
		$current_guard = $groups[1];
	}
}

uasort($guards, function($a, $b) {
	$a_total = array_sum($a);
	$b_total = array_sum($b);
	if($a_total == $b_total) return 0;
	return ($a_total > $b_total) ? -1 : 1;
});

$guard = array_keys($guards)[0];
$times = $guards[$guard];
$minute = array_keys($times, max($times))[0];

echo "Guard: " . $guard . "\n";
echo "Minute: " . $minute . "\n";
echo "Total: " . array_sum($times) . "\n";


$end = microtime(true);

echo "Result: " . (int)$guard*$minute . "\n";
echo "Time to process: " . ($end - $start)*1000 . "ms";