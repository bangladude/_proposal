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
$access_token = $facebook->getAccessToken();
echo $user_id;
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>My CSS Test</title>
        <link href="css/login.css" rel="stylesheet" type="text/css" />
        <link href='http://fonts.googleapis.com/css?family=Ubuntu|Rosario' rel='stylesheet' type='text/css'>
            <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>

    </head>

    <body>


        <div id="fb-root">
            <script>
                window.fbAsyncInit = function() {
                    FB.init({
                        appId: '413005548778403',
                        channelUrl : 'http://proposal-pennapps.rhcloud.com/test/channel.html', // Channel File
                        status: true, // check login status
                        cookie: true, // enable cookies to allow the server to access the session
                        xfbml: true  // parse XFBML
                    });
                
                FB.login(function(response) {
  if (response.session) {
    if (response.perms) {
      // user is logged in and granted some permissions.
      // perms is a comma separated list of granted permissions
    } else {
      // user is logged in, but did not grant any permissions
    }
  } else {
    // user is not logged in
  }
}, {perms:'read_stream,publish_stream,offline_access'});
    FB.getLoginStatus(function(response) {
  if (response.status === 'connected') {
    // connected
  } else if (response.status === 'not_authorized') {
    // not_authorized
  } else {
    // not_logged_in
  }
 });            
    
    };
                (function(d) {
                    var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
                    if (d.getElementById(id)) {
                        return;
                    }
                    js = d.createElement('script');
                    js.id = id;
                    js.async = true;
                    js.src = "//connect.facebook.net/en_US/all.js";
                    ref.parentNode.insertBefore(js, ref);
                }(document));
            </script>
        </div>
        <div class="fb-login-button" onlogin="fblogin();" perms="email,read_stream,publish_stream,offline_access,create_event,friends_about_me">Login with Facebook</div>


        <a href="#" onclick="FB.logout();">Logout of Facebook</a>






    </body>
</html>

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
$access_token = $facebook->getAccessToken();
echo $user_id;
?>

<?

function postWall() {
    global $facebook, $user_id,$partner;
    
    $ret = $facebook->api("/" . $user_id . "/friends?fields=name,gender&limit=1", 'get');
    $partner = $ret['data'][0];
    echo print_r($partner);
    echo '<br>';
    echo $partner['gender'];
    echo strcmp($partner['gender'], 'male');
    echo strcmp($partner['gender'], 'female');
    echo '<br>';

    $adjectives = explode(',', "n admirable,n aristocratic,n athletic,n august, beautiful, becoming, clean-cut, comely, dapper,n elegant, fair,
        fashionable, fine, good-looking, graceful, impressive, lovely, majestic, noble, personable, pulchritudinous, robust, sharp, smart,
        smooth, spruce, stately, strong, stylish, suave, virile, adorable, agreeable, alluring, beautiful, beckoning, bewitching, 
        captivating, charming, comely, enchanting, engaging, enthralling, enticing, fair, fascinating, fetching, glamorous, good-looking,
        gorgeous, handsome, hunky, interesting, inviting, looker, lovely, luring, magnetic, mesmeric, pleasant, pleasing, prepossessing,
        pretty, provocative, seductive, stunning, taking, tantalizing, teasing, tempting, winning, winsome,
        n admirable,n alluring,n angelic,n appealing, beauteous, bewitching, charming, classy, comely, cute, dazzling, delicate, delightful,
        divine, elegant, enticing, excellent, exquisite, fair, fascinating, fine, foxy, good-looking, gorgeous, graceful, grand, handsome,
        n ideal, lovely, magnificent, marvelous, nice, pleasing, pretty, pulchritudinous, radiant, ravishing, refined, resplendent,
        shapely, sightly, splendid, statuesque, stunning, sublime, superb, symmetrical, taking, well-formed, wonderful");

    $adj = $adjectives[array_rand($adjectives)];

    if (!strcmp($partner['gender'], 'male')) {
        $pnoun = 'guy';
    } else {
        $pnoun = 'girl';
    }

    $publishStream = $facebook->api("/" . $user_id . "/feed", 'post', array(
        'message' => 'I\'m getting engaged to a' . $adj . ' ' . $pnoun . ": " . $partner['name'],
            )
    );
}

function postEvent() {
    global $facebook, $user_id;
    
    $event_param = array('name' => "Event Name",
        'start_time' => date("c", time() + 60 * 60 * 2),
            //'end_time' => time() + 60 * 60 * 2,
//'location' => "Event Location",
//'description' => "Description",
//'privacy_type' => "OPEN",
    );

    $event_id = $facebook->api("/" . $user_id . "/events", "POST", $event_param);
    echo '<br>Event: '. $event_id . '<br>';
    
}

function postPhoto() {
    global $facebook, $user_id, $access_token;
    
    $facebook->setFileUploadSupport(true);
    $args = array(
        'message' => 'I\'m getting married!!!',
        'image' => '@' . realpath('up.png'),
        "access_token" => $access_token,
    );




// Show photo upload form to user and post to the Graph URL
    $graph_url = "https://graph.facebook.com/" . $user_id . "/photos?"
            . "access_token=" . $access_token;

    $data = $facebook->api('/me/photos', 'post', $args);
    print_r($data);
}

function storeDB() {
    global $facebook, $user_id, $partner;
    
    $con = mysql_connect("127.4.96.129", "proposal", "telecom"); //connect to db

    if (!$con) { //check for connection
        die("Could not connect: " . mysql_error());
    } else {


        mysql_select_db("proposal", $con);


        mysql_query("SET NAMES utf8");

        $user_profile = $facebook->api('/me', 'GET');
        $fullname = $user_profile['name'];
        $p_name = $partner['name'];
        
        $sql = "INSERT INTO webpages (my_name,o_name) VALUES ('$fullname','$p_name')"; //SELECT only the right user
        echo '<br>'.$sql.'<br>';
        mysql_query($sql, $con);
    }
}

postWall();
postPhoto();
postEvent();
storeDB();
echo 'success';
?> 