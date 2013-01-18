TEST
<?php

ini_set('display_errors','On'); ini_set('error_reporting','E_ALL | E_STRICT'); error_reporting(E_ALL);

echo "hello";

require_once 'goutte.phar';
use Goutte\Client;
$client = new Client();

$crawler = $client->request('GET', 'http://www.symfony-project.org/');
echo $crawler->filter('body');



?>
TEST