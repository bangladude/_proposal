<?php
?>
<html>
    <head>
        <title>Proposal</title>
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <link type="text/css" rel="stylesheet" href="css/innerStyle.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
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
                        <label for="postPhoto"> <input  id="postPhoto" name="postEvent" type="checkbox" value="ringpic"/>
                            Add picture of ring on Facebook</label>
                    </div>
                    <div id="webpage">
                        <label for="makePage"><input  id="makePage" type="checkbox" name="postEvent" value="webpage"/>
                            Create announcement webpage</label>
                    </div>

                    <div id="call">
                        <label for="callExcited">
                            <input  id="callExcited" name="callExcited" type="checkbox" value="phonecall" onClick="phoneClicked()"/>
                            Send a congratulatory phone call
                        </label>
                        <label for="phone">
                            Phone Number: 
                            <input id="phone" name="phone" type="text"/>

                        </label>

                    </div><!-- call -->

                    <div id="video">
                        <label for="recordResponse"><input id="recordResponse" name="recordResponse" type="checkbox" value="video" onClick="emailClicked()"/>
                            Record your friend's reaction</label>

                        <label for="email">
                            Email: <input id="email" name="email" type="text"/>
                        </label>
                    </div>

                    <input id="partner" name="partner" type="hidden"/>

                </form>
            </div>



            <div id=chooseFriend style="display:none;">

                <button id="chooseOther" onClick="reOpenChooser()">Choose different fiance</button>
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
                <h1> 
                    The deed is done.
                </h1>
            </div>


            <a id="link" style="display:none" href="#">Demo it!</a>

            <script>
                    var page = 1;


                    function phoneClicked() {
                        if (document.getElementById('callExcited').checked) {
                            document.getElementById('phone').style.display = 'block';
                        }
                        else {
                            document.getElementById('phone').style.display = 'none';
                        }
                    }
                    function emailClicked() {
                        if (document.getElementById('recordResponse').checked) {
                            document.getElementById('email').style.display = 'block';
                        }
                        else {
                            document.getElementById('email').style.display = 'none';
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
                        else if (page == 5){
                        	submitHack();
                            document.getElementById('submit').style.display = 'none';
                            document.getElementById('button').style.display = 'none';
                            document.getElementById('finished').style.display = 'block';
                        }
                    }
                    function clickURL() {
                        document.getElementById('link').click();
                    }


                    function submitHack() {
                        $.post("/script/index.php", $('#formHack').serialize());
                    }



            </script>
        </div>
        <footer>
            Created by: Shaanan Cohney, Nicole Limtiaco, Saajid Moyen, 
            Rigel Swavely
        </footer>


        <script type="text/javascript">
            //Facebook Selector Script
            jQuery(document).ready(function($) {
                $(".bt-fs-dialog").fSelector({
                    onSubmit: function(response) {
                        // example response usage
                        var selected_friends = [];
                        $.each(response, function(k, v) {
                            selected_friends[k] = v;
                        });
                        alert(selected_friends);
                    }
                });
            });
        </script>

    </body>
</html>
