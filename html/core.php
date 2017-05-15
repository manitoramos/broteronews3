<?php
$item=$_GET["item"];
$link = "http://steamcommunity.com/market/priceoverview/?currency=1&appid=730&market_hash_name=".$item;
$json_url = $link;
// jSON String for request
$json_string = 'success';

// Initializing curl
$ch = curl_init( $json_url );

// Configuring curl options
$options = array(
CURLOPT_RETURNTRANSFER => true,
CURLOPT_HTTPHEADER => array('Content-type: application/json') ,
CURLOPT_POSTFIELDS => $json_string
);

// Setting curl options
curl_setopt_array( $ch, $options );

// Getting results
$result = curl_exec($ch); // Getting jSON result string

