<?php
$url = 'https://hotel-elli.gr'; 
$keyword = 'hotel';

function checkKeywordInPage($url, $keyword) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Timeout after 10 seconds
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        $errorMessage = curl_error($ch);
        curl_close($ch);
        return "Error: $errorMessage";
    }
    curl_close($ch);
    if (stripos($response, $keyword) !== false) {
        return "Keyword '$keyword' found on $url";
    } else {
        return "Keyword '$keyword' not found on $url";
    }
}

$result = checkKeywordInPage($url, $keyword);
echo $result . "\n";
