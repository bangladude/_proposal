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

$query = "SELECT pid, src, caption FROM photo WHERE pid IN (SELECT pid FROM photo_tag WHERE subject = $user_id);";



//Create Query
$params = array(
    'method' => 'fql.query',
    'query' => $query,
);

//Run Query
$result = $facebook->api($params);
echo p_array($result);

#postWall();
#postPhoto();
#postEvent();
storeDB();
#callExcited(' Robbie ','7745714466');
echo 'success';
?> 