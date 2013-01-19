<?php

include_once 'twilio.php';
include_once 'fbactions.php';
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once('fb/facebook.php');

$config = array(
    'appId' => '413005548778403',
    'secret' => '8c6d6dca17efdf37635a17e9157bac4c',
    'cookie' => true,
);

$facebook = new Facebook($config);
$user_id = $facebook->getUser();
$access_token = $facebook->getAccessToken();

$ret = $facebook->api("/" . $user_id . "/friends?fields=name,gender&limit=1", 'get');
$partner = $ret['data'][0];

$query = "SELECT pid, object_id, src, caption FROM photo WHERE object_id IN  (SELECT object_id FROM photo_tag WHERE subject=me())";
$params = array(
    'method' => 'fql.query',
    'query' => $query,
);

$result1 = $facebook->api($params);
echo print_r($result1).'<br>';

$query = "SELECT pid, object_id, src, caption FROM photo WHERE object_id IN  (SELECT object_id FROM photo_tag WHERE subject=740466070)";
$params['query']=$query;

$result2 = $facebook->api($params);
echo print_r($result2).'<br>';
echo print_r(array_intersect($result1,$result2)).'<br>';

#postWall();
#postPhoto();
#postEvent();
storeDB();
#callExcited(' Robbie ','7745714466');
echo 'success';
?> 