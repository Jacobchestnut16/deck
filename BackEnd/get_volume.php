<?php
$host = '172.16.183.200';
$port = 12345;

$command = "get_volume";

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket === false) {
    die("Failed to create socket: " . socket_strerror(socket_last_error()));
}

$result = socket_connect($socket, $host, $port);
if ($result === false) {
    die("Failed to connect to $host:$port: " . socket_strerror(socket_last_error()));
}

socket_write($socket, $command, strlen($command));
$response = socket_read($socket, 2048);
socket_close($socket);

echo json_encode(['volume' => $response]);
?>
