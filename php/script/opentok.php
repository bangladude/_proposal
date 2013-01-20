<?php

require_once 'opentok/OpenTokSDK.php';
require_once 'opentok/OpenTokArchive.php';
require_once 'opentok/OpenTokSession.php';
$apiKey = '22597082';
$apiObj = new OpenTokSDK('22597082', '034e262cad99717c7bcb4ec2417ce4e2c453bc2d');

if (isset($_REQUEST['sessionId']) && $_REQUEST['sessionId']) {
    $sessionId = $_REQUEST['sessionId'];
} else {
    $session = $apiObj->create_session();
    $sessionId = $session->getSessionId();
}

$token1 = $apiObj->generate_token($sessionId);
$token2 = $apiObj->generate_token($sessionId);
?>



<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>OpenTok Getting Started</title>
  
  <p>Share this URL: <?php echo "http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]."?sessionId=".$sessionId; ?></p>
  
  <script src="http://static.opentok.com/v0.91/js/TB.min.js"></script>

  <script type="text/javascript">
    var apiKey = <?php echo '"'. $apiKey .'"' ?>;
    var sessionId = <?php echo '"'. $sessionId .'"' ?>;
    var token = <?php echo '"'. $token1 .'"' ?>;						

    TB.setLogLevel(TB.DEBUG); // Set this for helpful debugging messages in console

     var session = TB.initSession(sessionId);			
     session.addEventListener('sessionConnected', sessionConnectedHandler);			
     session.connect(apiKey, token);

     function sessionConnectedHandler(event) {
       alert('Hello world. I am connected to OpenTok :).');
     }
  </script>

  </head>

<body>
</body>
</html>