<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $exePath = $_POST['exe_path'];

    // Define the host and port to connect to the Python listener
    $host = '172.16.183.200';
    $port = 12345;

    // Create a socket
    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    if ($socket === false) {
        echo "socket_create() failed: " . socket_strerror(socket_last_error()) . "\n";
        exit;
    }

    // Connect to the listener
    $result = socket_connect($socket, $host, $port);
    if ($result === false) {
        echo "socket_connect() failed: " . socket_strerror(socket_last_error($socket)) . "\n";
        exit;
    }

    // Send the executable path to the listener
    socket_write($socket, $exePath, strlen($exePath));

    // Receive the response from the listener
    $response = socket_read($socket, 2048);
    socket_close($socket);

    echo $response;
} else {
    echo "Invalid request method.";
}
?>
