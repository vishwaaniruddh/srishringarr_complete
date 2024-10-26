<?php
$start = microtime(true);

// Your PHP code here

$end = microtime(true);
$executionTime = $end - $start;

echo "Server Response Time: " . round($executionTime, 4) . " seconds";
?>
