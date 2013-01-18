<?php
require_once('fb/facebook.php');

$config = array(
    'appId' => '413005548778403',
    'secret' => '8c6d6dca17efdf37635a17e9157bac4c',
    'cookie' => true,
);

$facebook = new Facebook($config);
$user_id = $facebook->getUser();
echo $user_id;
echo "hello"
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
                        channelUrl: 'http://proposal-pennapps.rhcloud.com/test/channel.html', // Channel File
                        status: true, // check login status
                        cookie: true, // enable cookies to allow the server to access the session
                        xfbml: true  // parse XFBML
                    });

                    
                
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
        <div class="fb-login-button" onlogin="fblogin();" perms="email">Login with Facebook</div>


        <a href="#" onclick="FB.logout();">Logout of Facebook</a>






    </body>
</html>
