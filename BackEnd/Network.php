<?php
// scan.php

header("Content-Type: text/event-stream");
header("Cache-Control: no-cache");
header("Connection: keep-alive");

function ping($host)
{
    $cmd = "sudo ping -c 1 " . escapeshellarg($host);
    $output = [];
    $status = 0;
    exec($cmd, $output, $status);

    if ($status === 0) {
        echo "data: <p>$host: up</p>\n\n";
    } else {
        echo "data: <p>$host: down</p>\n\n";
    }

    // Flush the output buffer to send the event immediately
    ob_flush();
    flush();
}

// Perform the scan for a range of IPs (modify as needed)
$ipBase = '172.16.183';
for ($i = 1; $i <= 255; $i++) {
    $ip = "$ipBase.$i";
    ping($ip);
}

?>
