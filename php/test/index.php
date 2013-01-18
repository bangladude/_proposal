<?php

// Displays errors
ini_set('display_errors', 'On');
ini_set('error_reporting', 'E_ALL | E_STRICT');
error_reporting(E_ALL);

function get_facebook_cookie($app_id, $application_secret) {
    $args = array();
    parse_str(trim($_COOKIE['fbs_' . $app_id], '"'), $args);
    ksort($args);
    $payload = '';
    foreach ($args as $key => $value) {
        if ($key != 'sig') {
            $payload .= $key . '=' . $value;
            // echo $key.'<br>';
        }
    }
    if (md5($payload . $application_secret) != $args['sig']) {
        return null;
    }
    return $args;
}

?>
<?php

//START LOGIN BLOCK


session_start();
$loggedin = 0;
require_once('fb/facebook.php');
$fbcookie = get_facebook_cookie('115538591892230', '25302a5a33d08ecd3f3a21a9f738a12a');


$config = array(
    'appId' => '115538591892230',
    'secret' => '25302a5a33d08ecd3f3a21a9f738a12a',
    'cookie' => true,
);

$facebook = new Facebook($config);
$facebook->setAccessToken($fbcookie['access_token']);
$user_id = $facebook->getUser();
echo $user_id;
echo "hello"

?>