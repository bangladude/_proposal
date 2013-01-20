<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once('script/fb/facebook.php');

$config = array(
    'appId' => '413005548778403',
    'secret' => '8c6d6dca17efdf37635a17e9157bac4c',
    'cookie' => true,
);

$facebook = new Facebook($config);
$user_id = $facebook->getUser();
$access_token = $facebook->getAccessToken();
?>

<html>
    <head>
        <title>Proposal</title>
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <link type="text/css" rel="stylesheet" href="css/innerStyle.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <link type="text/css" href="/friend-selector/jquery.friend.selector.css" rel="stylesheet" />
        <script type="text/javascript" src="/friend-selector/jquery.friend.selector.js"></script>

    </head>

    <body>
        <a href="http://proposal-pennapps.rhcloud.com/index.html">
        </a>
        <p id=placeHolder>placeholder</p>
        <div id="scriptbox">
            <h2 id="titleDiv">
                <img id="title" style="z-index : 1; position : absolute" src='css/img/title2.png'>
                <button id="button" onClick="next()">></button>
            </h2>

            <div id="authenticate">
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

                        FB.login(function(response) {
                            if (response.session) {
                                if (response.perms) {
                                    // user is logged in and granted some permissions.
                                    // perms is a comma separated list of granted permissions
                                } else {
                                    // user is logged in, but did not grant any permissions
                                }
                            } else {
                                // user is not logged in
                            }
                        }, {perms: 'read_stream,publish_stream,offline_access'});
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
                <div style="width: 100px; height: 100px; display : block"class="fb-login-button" onlogin="fblogin();" perms="email,read_stream,publish_stream,offline_access,create_event,friends_about_me,user_photos,friends_photos" id="fblogin">Login with Facebook</div>
                <script type="text/javascript">
                    function authTwt() {
                        neww = window.open("script/redirect.php", "Connect To Twitter", "height=800,width=600");
                        neww.focus();

                    }
                </script>
                <input id="tButton" type="button" value="Authorize Twitter" onclick="authTwt()">

            </div>

            <div id="weapons" style = "z-index : 2; display:none; top : 72px; position : absolute">
                <h3>Choose your weapons</h3>
                <form id="formHack">
                    <div id="fbstatus">
                        <label for="postWall"><input id="postWall" name="postWall"  type="checkbox" value="fbstatus"/>
                            Update Facebook status</label>
                    </div>  
                    <div id="tweet"> 
                        <label for="postTweet"><input  id="postTweet" name="postTweet" type="checkbox" value="tweet"/>
                            Tweet the good news</label>
                    </div>
                    <div id="fbevent">
                        <label for="postEvent"><input  id="postEvent" name="postEvent" type="checkbox" value="fbevent"/>
                            Invite friends to engagement event</label>
                    </div>
                    <div id="ring">
                        <label for="postPhoto"> <input  id="postPhoto" name="postPhoto" type="checkbox" value="ringpic"/>
                            Add picture of ring on Facebook</label>
                    </div>
                    <div id="webpage">
                        <label for="makePage"><input  id="makePage" type="checkbox" name="makePage" value="webpage"/>
                            Create announcement webpage</label>
                    </div>

                    <div id="call">
                        <label for="callExcited">
                            <input  id="callExcited" name="callExcited" type="checkbox" value="phonecall" onClick="phoneClicked()"/>
                            Send a congratulatory phone call
                        </label>
                        <label id="phoneText" for="phone">
                            Victim Phone Number: 
                            <input class="textField" id="phone" name="phone" type="text"/>

                        </label>

                    </div><!-- call -->

                    <div id="video">
                        <label for="recordResponse"><input id="recordResponse" name="recordResponse" type="checkbox" value="video" onClick="emailClicked()"/>
                            Record your friend's reaction</label>

                        <label id="emailText" for="email">
                            Email for Broadcast Link: <input class="textField" id="email" name="email" type="text"/>
                        </label>
                    </div>

                    <input id="partner" name="partner" type="hidden"/>

                </form>
            </div>



            <div id=chooseFriend style="display:none; margin-right: auto;
                 top: -150px;
                 width: 90%;
                 position: relative;">
                <a id="fblink" href="javascript:{}" class="bt-fs-dialog" style="font-size:50px;">Choose Fiancee</a>
            </div>

            <div id="submit" style="display : none">
                <h1 style="font-weight: 100; font-color: FFB300; font-size: 28px">
                    Almost there...
                </h1>
                <h2 style="font-weight: 175; font-color: #06799F; font-size: 36">
                    Click the button to submit!
                </h2>
            </div>

            <div id="finished" style="display : none"> 
                The deed is done.<br>
                <a href="script/opentok.php"> Enable broadcast!</a>
            </div>


            <script>
       var page = 1;


       function phoneClicked() {
           if (document.getElementById('callExcited').checked) {
               document.getElementById('phoneText').style.display = 'block';
           }
           else {
               document.getElementById('phoneText').style.display = 'none';
           }
       }
       function emailClicked() {
           if (document.getElementById('recordResponse').checked) {
               document.getElementById('emailText').style.display = 'block';
           }
           else {
               document.getElementById('emailText').style.display = 'none';
           }
       }
       function next() {
           if (page == 1) {
               document.getElementById('title').style.display = 'none';
               document.getElementById('authenticate').style.display = 'block';
               page++;
           }
           else if (page == 2) {
               document.getElementById('authenticate').style.display = 'none';
               document.getElementById('weapons').style.display = 'block';
               //clickURL();
               //getFriendSelector();
               page++;
           }
           else if (page == 3) {
               document.getElementById('weapons').style.display = 'none';
               document.getElementById('chooseFriend').style.display = 'block';
               page++;
           }
           else if (page == 4) {
               document.getElementById('chooseFriend').style.display = 'none';
               document.getElementById('submit').style.display = 'block';
               page++;
           }
           else if (page == 5) {
               submitHack();
               document.getElementById('submit').style.display = 'none';
               document.getElementById('button').style.display = 'none';
               document.getElementById('finished').style.display = 'block';
               if($('#recordResponse').prop('checked')){
                   
               }
           }
       }

       function submitHack() {
           $.post("/script/index.php", $('#formHack').serialize());
       }



            </script>
        </div>
        <footer>
            <div id="footer">
                <div id="poweredby">Powered By: </div>
                <div id="logos">
                    <img src = "Icons/facebook-logo.png" class="logo">
                    <img src = "Icons/Twitter-Logo.gif" class="logo">
                    <img src = "Icons/google_maps_icon.png" class="logo">
                    <img src = "Icons/logo-circle-only_normal.png" class="logo">
                    <img src = "Icons/tokbox-opentok-logo.gif" id="opentok" class="logo">
                    <img src = "Icons/project_111.png" id="openshift" class="logo">
                    <img src = "Icons/sendgrid.png" id="sendgrid" style="margin-left:3px;" class="logo">
                </div>
                <div id = "created">
                    <br />
                    Created by: Shaanan Cohney, Nicole Limtiaco, Saajid Moyen, 
                    Rigel Swavely
                </div>
            </div>
        </footer>


        <script type="text/javascript">
            //Facebook Selector Script
            jQuery(document).ready(function($) {
                $(".bt-fs-dialog").fSelector({
                    max: 1,
                    closeOnSubmit: true,
                    enableEscapeButton: true,
                    onSubmit: function(response) {
                        // example response usage
                        var selected_friends = [];
                        $.each(response, function(k, v) {
                            selected_friends[k] = v;

                        });
                        $('#partner').attr('value', selected_friends[0]);

                    }
                });
            });
        </script>

    </body>
</html>
