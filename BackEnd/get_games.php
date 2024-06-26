<?php
$host = '172.16.183.200';  // Python listener host
$port = 12345;        // Python listener port

// Request games list from the Python listener
$message = 'scan_games|C:\\XboxGames';

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket === false) {
    die("Unable to create socket: " . socket_strerror(socket_last_error()));
}

$result = socket_connect($socket, $host, $port);
if ($result === false) {
    die("Unable to connect to server: " . socket_strerror(socket_last_error($socket)));
}

socket_write($socket, $message, strlen($message));

$response = '';
while ($out = socket_read($socket, 2048)) {
    $response .= $out;
}

socket_close($socket);

// Decode JSON response and return it
header('Content-Type: application/json');
echo $response;
?>
