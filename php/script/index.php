<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

include_once 'twilio.php';
include_once 'fbactions.php';
include_once 'twitter.php';




require_once('fb/facebook.php');

$config = array(
    'appId' => '413005548778403',
    'secret' => '8c6d6dca17efdf37635a17e9157bac4c',
    'cookie' => true,
);

$facebook = new Facebook($config);
$user_id = $facebook->getUser();
$access_token = $facebook->getAccessToken();

#echo print_r($_POST).'<br><br><br><br>';
$partner_t = $_POST['partner'];

$partner = $facebook->api("/" . $partner_t, 'get');
echo print_r($partner);


$phone = $_POST['phone'];
$_SESSION['email'] = $_POST['email'];

$ret = $facebook->api("/" . $user_id . "?fields=first_name,gender&limit=1", 'get');
$first_name = $ret['first_name'];

## TEST VALUES
#$partner = 740466070;
#$_SESSION['email'] = 'shaananc@gmail.com';


$postWall = $_POST['postWall'];
$postPhoto = $_POST['postPhoto'];
$postEvent = $_POST['postEvent'];
$callExcited = $_POST['callExcited'];
$storeDB = $_POST['makePage'];
$postTweet = $_POST['postTweet'];
#callExcited(' Air Hood ', '4257537287');
#callExcited(' Richard ', '2152726847');
$_SESSSION['finalurl'] = storeDB();
echo $_SESSSION['finalurl'];

if ($storeDB) {
    $attachment = array(
        'message' => 'This is all the information about my big life move!! Sooo looking forward to the the next days of my life...',
        'name' => 'Engagement!',
        'link' => $_SESSSION['finalurl'],
    );


    $result = $facebook->api('/me/feed/', 'post', $attachment);
}
if ($postWall) {
    echo 'Wall Post Activated';
    postWall();
}
if ($postPhoto) {
    echo 'Photo Post Activated';
    postPhoto();
}
if ($postEvent) {
    echo 'Event';
    postEvent();
}

if ($callExcited) {
    echo 'Call Activated';
    callExcited(' ' . $partner['first_name'] . ' ', $phone);
}
if ($postTweet) {
    echo 'Tweet Activated';
    postTweet();
}
?> 