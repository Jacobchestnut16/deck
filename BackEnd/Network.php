<?php
// ping.php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ip'])) {
    $ip = $_POST['ip'];
    $cmd = "sudo ping -c 1 " . escapeshellarg($ip);
    exec($cmd, $output, $status);

    if ($status === 0) {
        $result = "$ip UP";
        $response = ['status' => 'success', 'result' => $result];
    } else {
        $result = "$ip DOWN";
        $response = ['status' => 'error', 'result' => $result];
    }

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
