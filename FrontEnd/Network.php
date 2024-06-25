<?php
function pingDevice($ip) {
    $cmd = "/bin/ping -c 1 $ip"; // Linux example
    exec($cmd, $output, $result);
    foreach ($output as $line) {
        echo $ip." ".$line;
    }
    if ($result == 0) {
        return true; // Device is up
    } else {
        return false; // Device is down
    }
}
function searchNetwork($ip)
{
    for ($i = 0; $i < 255; $i++) {
        echo "<table><tr>";

        $ipLookup = $ip . '.' . $i;
        echo "<td>";
        if (pingDevice($ipLookup)) {
            //echo "Device at $ipLookup is up.";
        } else {
            //echo "Device at $ipLookup is down.";
        }
        echo "</td>";
        $hostname = gethostbyaddr($ip);
        echo "<td>";
        if ($hostname === false) {
            //echo "Reverse DNS lookup failed or no hostname found.";
        } else {
            echo "Hostname for IP $ip is: $hostname";
        }
        echo "</td>";
        echo "</tr></table>";
    }
}
$hostname = gethostname();
$local_ip = gethostbyname($hostname);

echo "Private IP address: $local_ip";
$server_ip = $_SERVER['SERVER_ADDR'];

echo "Server IP address: $server_ip";


function getLocalNetworkIP()
{
    $local_ip = trim(shell_exec("hostname -I | awk '{print $1}'"));
    return $local_ip;
}

$local_ip = getLocalNetworkIP();
echo "Local Network IP address: $local_ip";


//searchNetwork('192.168.46');
searchNetwork('172.16.183');

?>