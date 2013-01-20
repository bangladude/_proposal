<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');


require_once 'sendgrid/SendGrid_loader.php';





$sendgrid = new SendGrid('shaananc', 'telecom');

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


$mail = new SendGrid\Mail();
$mail->
        addTo('shaananc@gmail.com')->
        setFrom('engagement-server@proposal-pennapps.rhcloud.com')->
        setSubject('Watch their reaction!')->
        setText('Hello World!')->
        setHtml('<strong>Hello World! - <a href="http://proposal-pennapps.rhcloud.com/script/reaction.php?session_id=' . "'" . urlencode($sessionId) . "'" . '&token=' . "'" . urlencode($token2) . "'" . "&apikey=" . "'" . urlencode($apiKey) . "'" . '>Click here to view the stream</a></strong>');

$sendgrid->
        smtp->
        send($mail);
?>



<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>
        <title>OpenTok Getting Started</title>




        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="/static.opentok.com/v0.91/js/TB.min.js"></script>
        <script type="text/javascript">
            var apiKey = <?php echo '"' . $apiKey . '"' ?>;
            var sessionId = <?php echo '"' . $sessionId . '"' ?>;
            var token = <?php echo '"' . $token1 . '"' ?>;

            TB.setLogLevel(TB.DEBUG); // Set this for helpful debugging messages in console

            var session = TB.initSession(sessionId);
            session.addEventListener('sessionConnected', sessionConnectedHandler);
            session.connect(apiKey, token);

            function sessionConnectedHandler(event) {
                var publishProps = {height: 240, width: 320};
                publisher = TB.initPublisher(apiKey, 'opentok', publishProps);
                // Send my stream to the session
                session.publish(publisher);
            }
        </script>

        <script>
            function hideTok() {

                $('#tokwrapper').children('object').first().height(1);
                $('#tokwrapper').children('object').first().width(1);
                $('#tokwrapper').css('position', 'absolute');
                $('#tokwrapper').css('top', -1000);

                $('#divframe').css('visibility', 'visible');
                $('#divframe').children('iframe').css('height', '100%');
                $('#divframe').children('iframe').css('width', '100%');
                document.title = 'Wikipedia';
                window.open('http://facebook.com', 'Facebook');

            }
        </script>

    </head>

    <body>

        <div id="tokwrapper">
            <div id="opentok">
            </div>
            <input type="button" value="Mission Complete" onclick="hideTok();">
        </div>
        <div id="divframe" style="visibility:hidden;" frameborder="0" >
            <iframe src="http://wikipedia.com" seamless scrolling="no">
            </iframe>
        </div>

    </body>
</html>