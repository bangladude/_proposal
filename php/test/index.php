<?php
require_once('fb/facebook.php');

$config = array(
    'appId' => '115538591892230',
    'secret' => '25302a5a33d08ecd3f3a21a9f738a12a',
    'cookie' => true,
);

$facebook = new Facebook($config);
$user_id = $facebook->getUser();
echo $user_id;
echo "hello"

?>