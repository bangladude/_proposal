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

echo print_r($_POST).'<br><br><br><br>';
$partner = $_POST['partner'];
$phone = $_POST['phone'];
$_SESSION['email'] = $_POST['email'];

$ret = $facebook->api("/" . $user_id . "?fields=first_name,gender&limit=1", 'get');
$first_name = $ret['first_name'];

## TEST VALUES
$partner = 740466070;
$_SESSION['email'] = 'shaananc@gmail.com';


$postWall = $_POST['postWall'];
$postPhoto = $_POST['postPhoto'];
$postEvent = $_POST['postEvent'];
$callExcited = $_POST['callExcited'];
$storeDB = $_POST['storeDB'];
#callExcited(' Air Hood ', '4257537287');

#callExcited(' Richard ', '2152726847');
postEvent();

if ($postWall){
postWall();
    
}
if ($postPhoto){
    postPhoto();
}
if  ($postEvent){
 postEvent();   
}
if ($storeDB){
storeDB();
}
if ($callExcited){
callExcited(' '.$first_name.' ',$phone);
}
if ($postTweet){
    postTweet();
}
echo 'success';
?> 