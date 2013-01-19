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

// Show photo upload form to user and post to the Graph URL
$graph_url = "https://graph.facebook.com/".$user_id."/photos?"
        . "access_token=" . $access_token;

echo '<html><body>';
echo '<form enctype="multipart/form-data" action="'
 . $graph_url . ' "method="POST">';
echo 'Please choose a photo: ';
echo '<input name="source" type="file"><br/><br/>';
echo 'Say something about this photo: ';
echo '<input name="message" 
             type="text" value=""><br/><br/>';
echo '<input type="submit" value="Upload"/><br/>';
echo '</form>';
echo '</body></html>';
?>