<?php

include_once 'twilio.php';
include_once 'fbactions.php';
#include_once 'mapembed.php';

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

$ret = $facebook->api("/" . $user_id . "/friends?fields=name,gender&limit=1", 'get');
$partner = $ret['data'][0];

$query = "SELECT pid, object_id, images, like_info FROM photo WHERE object_id IN  (SELECT object_id FROM photo_tag WHERE subject=me())";
$params = array(
    'method' => 'fql.query',
    'query' => $query,
);

$result1 = $facebook->api($params);


$query2 = "SELECT object_id FROM photo WHERE object_id IN  (SELECT object_id FROM photo_tag WHERE subject= 527355783)";
$params['query']=$query2;
$result2 = $facebook->api($params);
$max = -1;
foreach ($result1 as &$value1) {
   foreach($result2 as &$value2){
       if($value1['object_id'] == $value2['object_id']){
           
           $ret = $facebook->api("/" . $value1['object_id'] . "?fields=tags", 'get');
           #echo '<br>'.print_r($ret['tags']['data']).'<br>';
           if(count(($ret['tags']['data'])) != 2){break;}
           
           if($value1['like_info']['like_count']  > $max){
               $max = $value1['like_info']['like_count'];
               $final = $value1['images'];
           }
       }
   }
}

echo '<img src="'.$final[0]['source'].'" >';

#postWall();
#postPhoto();
#postEvent();
storeDB();
#callExcited(' Nikki ','6103047974');
echo 'success';
?> 