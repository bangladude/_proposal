<?php

session_start();
require_once('twitter/twitteroauth.php');
require_once('config.php');

function postTweet(){
/* If access tokens are not available redirect to connect page. */
if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
    header('Location: ./clearsessions.php');
}
/* Get user access tokens out of the session. */
$access_token = $_SESSION['access_token'];


/* Create a TwitterOauth object with consumer/user tokens. */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

$user = $connection->get('account/verify_credentials');


/* statuses/update */
date_default_timezone_set('GMT');

#$parameters = array('status' => date(DATE_RFC822));
$parameters = array('status' => 'I\'m engaged!!!!!!');
$status = $connection->post('statuses/update', $parameters);
return $status;
}

?>