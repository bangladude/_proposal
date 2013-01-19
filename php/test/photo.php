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
$access_token = $facebook->getAccessToken();
$user_id = $facebook->getUser();
echo $user_id;
echo '<b>'
?>

<?php

$facebook->setFileUploadSupport(true);
$args = array(
    'message' => 'Caption',
    'image'=> '@'.realpath('up.png')
);
    
    
  

// Show photo upload form to user and post to the Graph URL

$data = $facebook->api('/me/photos', 'post', $args);
print_r($data);
?>