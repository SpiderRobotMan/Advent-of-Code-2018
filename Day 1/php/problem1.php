<?php
$start = microtime(true);

$frequency = 0;

$file = file_get_contents(__DIR__ . "/../input.txt");
$lines = explode("\n", trim($file));

foreach($lines as $line) $frequency += (int)$line;

$end = microtime(true);

echo "Result: " . $frequency . "\n";
echo "Time to process: " . ($end - $start)*1000 . "ms";