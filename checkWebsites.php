<?php
$websites = [
    'https://www.hotel-elli.gr',
    'https://www.akinito24.gr',
];

// Function to check the status of a website
function checkWebsiteStatus($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, TRUE); 
    curl_setopt($ch, CURLOPT_NOBODY, TRUE); 
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_exec($ch);

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return $httpCode;
}

foreach ($websites as $website) {
    $status = checkWebsiteStatus($website);
    echo "Website: $website - Status: $status";

    if ($status == 200) {
        echo " (Online)\n";
    } else {
        echo " (Offline or Unreachable)\n";
    }
}
