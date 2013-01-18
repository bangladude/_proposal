<?php
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
echo $user_id;
?>
<?
$session = $facebook->getSession();
$access_token = $session['access_token'];
if ($user_id) {
    $data = array(
        'access_token' => $access_token,
        'message' => 'Hi, This is my first message from facebook graph API. Downloaded from http://www.digimantra.com'
    );


    $return = json_decode(make_post('https://graph.facebook.com/' . $user_id . '/feed', $data));
}
echo 'success';
?> 