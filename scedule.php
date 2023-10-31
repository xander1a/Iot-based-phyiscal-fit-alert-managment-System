<?php
// Specify the URL of the target PHP file
$targetUrl = "https://fit.rwandahouseland.com/sendSms.php";

// Set the refresh interval (in seconds)
$refreshInterval = 300; // 5 minutes

// Function to make the HTTP request to the target script
function refreshTargetScript($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);
}

// Continuously refresh the target script at the specified interval
while (true) {
    refreshTargetScript($targetUrl);
    sleep($refreshInterval);
}
