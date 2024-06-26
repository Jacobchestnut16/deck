<?php
require 'vendor/autoload.php'; // Include Composer's autoloader

use phpseclib3\Net\SSH2;

$ssh = new SSH2('172.16.183.200');
if (!$ssh->login('e.jmc16@outlook.com', 'Elle Theobald')) {
    // Redirect back to the original page with an error message
    header('Location: index.html?error=Login+Failed');
    exit();
}

// Execute the command to open YouTube
$output = $ssh->exec('powershell.exe -Command cd "C:\\Users\\Jacob Chestnut\\AppData\\Local\\Programs\\Opera\\"');
$output = $ssh->exec('powershell.exe -Command Start-Process "opera.exe" "https://www.youtube.com"');
$status = $ssh->getExitStatus();

if ($status !== 0) {
    // Redirect back to the original page with an error message
    header('Location: index.html?error=Command+Failed');
    exit();
}

// Redirect back to the original page on success
header('Location: index.html?success=YouTube+Opened');
exit();
?>
