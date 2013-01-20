<?php

$token = $_GET['token'];
$sessionId = $_GET['session_id'];
$apiKey = $_GET['apikey'];

?>

<head>
        <script src="TB.js"></script>
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

            // Subscribe to streams that were in the session when we connected
            subscribeToStreams(event.streams);
        }
    
    function subscribeToStreams(streams) {
      for (var i = 0; i < streams.length; i++) {
        // Make sure we don't subscribe to ourself
        if (streams[i].connection.connectionId == session.connection.connectionId) {
          return;
        }

        // Create the div to put the subscriber element in to
        var div = document.createElement('div');
        div.setAttribute('id', 'stream' + streams[i].streamId);
        document.body.appendChild(div);

        // Subscribe to the stream
        session.subscribe(streams[i], div.id);
      }
    }
    </script>

</head>
<body>
    <div id ="opentok">

    </div>
</body>