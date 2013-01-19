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


    $event_param = array('name' => "Event Name",
        'start_time' => date("c", time() + 60 * 60 * 2),
            //'end_time' => time() + 60 * 60 * 2,
            //'location' => "Event Location",
            //'description' => "Description",
            //'privacy_type' => "OPEN",
    );

    $event_id = $facebook->api("/" . $user_id . "/events", "POST", $event_param);
    echo $event_id;


    $con = mysql_connect("127.4.96.129", "proposal", "telecom"); //connect to db

    if (!$con) { //check for connection
        die("Could not connect: " . mysql_error());
    } else {


        mysql_select_db("proposal", $con);
        
        
            mysql_query("SET NAMES utf8");
    
    $user_profile = $facebook->api('/me','GET');
    $fullname = $user_profile['name'];
    
    $sql = "INSERT INTO webpages (my_name,o_name) VALUES ('$fullname','Ella', '$fullname' ,$fbid)"; //SELECT only the right user
    mysql_query($sql, $con);
        
    }

}



echo 'success';
?> 