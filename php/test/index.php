<?php

include_once 'twilio.php';
include_once 'fbactions.php';
include_once 'mapembed.php';

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
$partner = 740466070;


#postWall();
#postPhoto();
#postEvent();
storeDB();
#callExcited(' Nikki ','9736414198');
echo 'success';
?> 