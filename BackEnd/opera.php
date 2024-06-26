<?php
$host = '172.16.183.200';
$port = 12345;

// Command to execute
$command = 'powershell.exe -Command "Start-Process \'C:\\Users\\Jacob Chestnut\\AppData\\Local\\Programs\\Opera\\opera.exe\'"';

// Create a socket
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket === false) {
    echo "Failed to create socket: " . socket_strerror(socket_last_error()) . "\n";
    exit;
}

// Connect to the server
$result = socket_connect($socket, $host, $port);
if ($result === false) {
    echo "Failed to connect to $host:$port: " . socket_strerror(socket_last_error()) . "\n";
    exit;
}

// Send the command
socket_write($socket, $command, strlen($command));

// Receive the response
$response = socket_read($socket, 2048);
echo "Response from server: " . $response . "\n";

// Close the socket
socket_close($socket);
header('Location: ../index.html');
exit();
?>
