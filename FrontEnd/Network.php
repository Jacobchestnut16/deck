<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


error_reporting(E_ALL);
ini_set('display_errors', 1);

function ping($host)
{
    $cmd = "sudo ping -c 4 " . escapeshellarg($host);

    // Execute the ping command
    $output = [];
    $status = 0;
    exec($cmd, $output, $status);

    if ($status === 0) {
        return [
            'status' => 'success',
            'output' => implode("\n", $output)
        ];
    } else {
        return [
            'status' => 'error',
            'output' => "Ping failed with status $status."
        ];
    }
}

$lanAddress = '192.168.1.1'; // Replace with your LAN address

function searchNetwork($ip)
{
    for ($i = 1; $i < 255; $i++) {
        echo "<table><tr>";

        $ipLookup = $ip . '.' . $i;
        echo "<td> Pinging ".$ipLookup;
        $result = ping($ipLookup);

        if ($result['status'] === 'success') {
            echo "<pre>".$ipLookup.": up</pre>";
        } else {
            echo "<pre>".$ipLookup.": down</pre>";
        }
        echo "</td>";
//        $hostname = gethostbyaddr($ip);
//        echo "<td>";
//        if ($hostname === false) {
//            //echo "Reverse DNS lookup failed or no hostname found.";
//        } else {
//            echo "Hostname for IP $ip is: $hostname";
//        }
//        echo "</td>";
        echo "</tr></table>";
    }
}
function getLocalNetworkIP()
{
    $local_ip = trim(shell_exec("hostname -I | awk '{print $1}'"));
    return $local_ip;
}

$local_ip = getLocalNetworkIP();
echo "Local Network IP address: $local_ip";


//searchNetwork('192.168.46');
searchNetwork('172.16.183');
//searchNetwork('127.0.0');

?>