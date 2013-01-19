<?php

function callExcited($pname) {

    #write the call file
    
    $myFile = "call.xml";
    $fh = fopen($myFile, 'w') or die("can't open file");
    $stringData = '<?xml version="1.0" encoding="UTF-8"?>
<Response>
    <Say voice="woman" language="en">You have a prerecorded message from'. $pname .'.</Say>
    <Play>https://proposal-pennapps.rhcloud.com/test/gratz.mp3</Play>
    <Say voice="woman" language="en">End of recorded message.</Say>
</Response>';
    fwrite($fh, $stringData);

// Include the Twilio PHP library
    require 'twilio/Services/Twilio.php';

// Twilio REST API version
    $version = "2010-04-01";

// Set our Account SID and AuthToken
    $sid = 'ACdc40c140e5c4bdab3366e7252bfec313';
    $token = 'a09a0f48423b02f3b878c24b8f85682c';

// A phone number you have previously validated with Twilio
    $phonenumber = '2679334460';

// Instantiate a new Twilio Rest Client
    $client = new Services_Twilio($sid, $token, $version);

    try {
        // Initiate a new outbound call
        $call = $client->account->calls->create(
                $phonenumber, // The number of the phone initiating the call
                '2152726847', // The number of the phone receiving call
                'https://proposal-pennapps.rhcloud.com/test/call.xml' // The URL Twilio will request when the call is answered
        );
        echo 'Started call: ' . $call->sid;
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

?>