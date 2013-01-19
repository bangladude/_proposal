<?php

$url = 'https://api.twitter.com/oauth/request_token';
//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, 0);
#curl_setopt($ch,CURLOPT_POST, count($fields));
#curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

//execute post
$response = curl_exec($ch);

curl_close($ch);

echo $response;

?>
