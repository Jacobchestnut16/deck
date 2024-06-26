<?php
$host = 'windows_machine_ip';
$port = 12345;

if (isset($_POST['volume'])) {
    $volume = floatval($_POST['volume']);
    $command = "set_volume:$volume";

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

    echo $response;
} else {
    echo "Volume parameter not provided";
}
?>
