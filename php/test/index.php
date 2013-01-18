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

if ($user_id) {
    $publishStream = $facebook->api("/" . $user_id . "/feed", 'post', array(
        'message' => 'I love thinkdiff.net for facebook app development tutorials. <img src="http://thinkdiff.net/wp-includes/images/smilies/icon_smile.gif" alt=":)" class="wp-smiley"> ',
        'link' => 'http://ithinkdiff.net',
        'picture' => 'http://thinkdiff.net/ithinkdiff.png',
        'name' => 'iOS Apps & Games',
        'description' => 'Checkout iOS apps and games from iThinkdiff.net. I found some of them are just awesome!'
            )
    );

    $Facebook_event = array('name' => "Event Name",
        'start_time' => mktime("14", "30", "00", "08", "01", "2010"),
        'category' => "1", 'subcategory' => "1",
        'location' => "Event Location",
        'end_time' => mktime("15", "30", "00", "08", "01", "2010"),
        'street' => "1111 Grand Central Statio",
        'city' => "New York",
        'email' => "youremail@email.com",
        'description' => "Description",
        'privacy_type' => "OPEN",
    );
    
    $event_utf8 = array_map(utf8_encode, $Facebook_event);
    
    $event_parameters = array( 'method' => 'events.create', 'uids' => $id, 'event_info' => json_encode($event_utf8), 'callback' => '' );
}
echo 'success';
?> 