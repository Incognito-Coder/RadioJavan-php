<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

if (isset($_GET['url'])) {
    if (str_contains($_GET['url'], 'play.radiojavan.com')) {
        echo callAPI($_GET['url']);
    } else {
        echo callAPI(extractWebUrl($_GET['url']));
    }
}

function callAPI($url)
{
    $client = new Client();
    $headers = [
        'sec-ch-ua' => '"Google Chrome";v="111", "Not(A:Brand";v="8", "Chromium";v="111"',
        'User-Agent' => 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Mobile Safari/537.36',
        'Accept' => 'application/json, text/plain, */*',
        'x-rj-user-agent' => 'Radio Javan/4.0.2/d3da4d5b1c90247b3c0a569e9980197e763b1af0 (iOS 13.3.1 13.0.5) com.radioJavan.rj.desktop',
        'x-api-key' => '40e87948bd4ef75efe61205ac5f468a9fd2b970511acf58c49706ecb984f1d67',
        'sec-ch-ua-platform' => '"Android"'
    ];
    $query = parse_url($url, PHP_URL_PATH);
    $path = explode('/', $query);
    $request = new Request('GET', 'https://play.radiojavan.com/api/p/mp3?id=' . $path[2], $headers);
    $res = $client->send($request);
    return $res->getBody();
}
function extractWebUrl($url)
{
    $client = new Client();
    $headers = [
        'sec-ch-ua' => '"Google Chrome";v="111", "Not(A:Brand";v="8", "Chromium";v="111"',
        'User-Agent' => 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Mobile Safari/537.36',
        'Accept' => 'application/json, text/plain, */*',
        'x-rj-user-agent' => 'Radio Javan/4.0.2/d3da4d5b1c90247b3c0a569e9980197e763b1af0 (iOS 13.3.1 13.0.5) com.radioJavan.rj.desktop',
        'x-api-key' => '40e87948bd4ef75efe61205ac5f468a9fd2b970511acf58c49706ecb984f1d67',
        'sec-ch-ua-platform' => '"Android"'
    ];
    $request = new Request('GET', $url, $headers);
    $res = $client->send($request);
    preg_match('/<meta property="og:url" content="(.*?)" \/>/', $res->getBody(), $matches);
    return $matches[1];
}

/*

Dev : Alireza Ah-Mand
Telegram @IC_Mods

*/