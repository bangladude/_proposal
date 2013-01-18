TEST
<?php

ini_set('display_errors','On'); ini_set('error_reporting','E_ALL | E_STRICT'); error_reporting(E_ALL);

echo "hello";
require_once('__init__.php');
// This would be the url of the host running the server-standalone.jar
$wd_host = 'http://ftp.shaanan.cohney.info:4444/wd/hub'; // this is the default
echo "hello";
$web_driver = new WebDriver();


// First param to session() is the 'browserName' (default = 'firefox')
// Second param is a JSON object of additional 'desiredCapabilities'

// POST /session
echo "hello"; 
$session = $web_driver->session('internet explorer');
echo "hello";
$session->open('http://www.facebook.com/cocacola');
echo $session->source();



?>
TEST