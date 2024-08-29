<?php

function scrapeWebsite($url)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3");
    $html = curl_exec($ch);

    if(curl_errno($ch)) {
        echo 'cURL error: ' . curl_error($ch);
        curl_close($ch);
        return;
    }

    curl_close($ch);

    $dom = new DOMDocument;
    @$dom->loadHTML($html);
    $xpath = new DOMXPath($dom);

    $titles = $xpath->query('//h1');
    if ($titles->length > 0) {
        echo "Title: " . $titles->item(0)->nodeValue . "\n";
    }

    $paragraphs = $xpath->query('//p');
    foreach ($paragraphs as $paragraph) {
        echo "Paragraph: " . $paragraph->nodeValue . "\n";
    }

    $links = $xpath->query('//a[@href]');
    foreach ($links as $link) {
        $href = $link->getAttribute('href');
        $linkText = $link->nodeValue;
        echo "Link: $linkText ($href)\n";
    }
}

$url = '';

scrapeWebsite($url);

