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

$highest_guard = 0;
$highest_amount = 0;
$highest_minute = 0;

foreach($guards as $guard=>$times) {
	if($times == null) continue;
	foreach($times as $minute => $amount) {
		if($amount > $highest_amount) {
			$highest_amount = $amount;
			$highest_minute = $minute;
			$highest_guard = $guard;
		}
	}
}

echo "Guard: " . $highest_guard . "\n";
echo "Minute: " . $highest_minute . "\n";
echo "Amount: " . $highest_amount . "\n";

$end = microtime(true);

echo "Result: " . (int)$highest_guard*$highest_minute . "\n";
echo "Time to process: " . ($end - $start)*1000 . "ms";