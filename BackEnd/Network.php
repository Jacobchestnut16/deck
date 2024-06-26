<?php
// ping.php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ip'])) {
    $ip = $_POST['ip'];
    $cmd = "sudo ping -c 1 " . escapeshellarg($ip);
    exec($cmd, $output, $status);

    if ($status === 0) {
        $result = "up";
        $response = ['status' => 'success', 'result' => $result, 'ip' => $ip];
    } else {
        $result = "down";
        $response = ['status' => 'error', 'result' => $result, 'ip' => $ip];
    }

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
