<?php

    $con = mysql_connect("127.4.96.129", "proposal", "telecom"); //connect to db

    if (!$con) { //check for connection
        die("Could not connect: " . mysql_error());
    } else {


        mysql_select_db("proposal", $con);


        mysql_query("SET NAMES utf8");
        $id = $_GET['id'];
        
        $sql = "SELECT * FROM webpages WHERE id='$id'"; //SELECT only the right user
        $result = mysql_query($sql, $con);
        $row = mysql_fetch_array($result);
        if(!$row){die("No such page exists");}
    }
    


?>

<html>
    <head>
        <title>Proposal App</title>
        <link type="text/css" rel="stylesheet" href="style.css">
        <link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Cabin+Condensed' rel='stylesheet' type='text/css'>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script>$(document).ready(function() {
                setTimeout(function() {
                    $('#imbox').fadeOut(function() {
                        $('#imbox').html("").append('<div id="story"/>');
                        $('#story').html("Our Story is long and filled with sorrow. But it all ends well!");
                        $('#imbox').fadeIn();
                    });
                }, 3500);

            });</script>
    </head>
    <body>
        <div id="title" style="font-family: 'Poiret One'; font-size: 80px; margin-bottom:30px; background-color: #000"><center>We are Engaged!</center></div>
        <?php echo $id ?>
        <div id="scriptbox" style="width:75%; background-color: #000" >
            <div id="heading" style="font-family: 'Cabin Condensed'; font-size:66px; text-align:center; margin-bottom:25px;">
                <?php echo $row['my_name'] . ' and ' . 'Shadia' ?> wish to share their engagement with you. 
                <div style="height:60%;">
                    <div id="imbox" class="image" style="position:relative;">   
                        <img src="http://dancevibe.com.au/wp-content/uploads/2012/03/white-couple.jpg" style=" margin-top:30px; margin-left:auto; margin-right:auto; display:block;height:95%; width:40%;">
                        <div class="text" style="position:absolute; top:80%; left:38%; font-family: 'Helvetica'; font-size:50px;">"So in love are we two..."</div>
                    </div>
                </div> 
            </div>
            <div style="text-align:center; margin:auto;">
                <div id="leftbar" style="display:inline-block; margin-right:10px; width:45%;">

                    <img border="0" src="//maps.googleapis.com/maps/api/staticmap?center=Brooklyn+Bridge,New+York,NY&amp;zoom=13&amp;size=600x300&amp;maptype=roadmap&amp;markers=color:blue%7Clabel:S%7C40.702147,-74.015794&amp;markers=color:green%7Clabel:G%7C40.711614,-74.012318&amp;markers=color:red%7Clabel:C%7C40.718217,-73.998284&amp;sensor=false" alt="Points of Interest in Lower Manhattan" style="vertical-align:middle;">
                </div>
                <div id="rightbar" style="display:inline-block; margin-left:10px; width: 45%; background-color: #abc; border-radius:10px;">
                    The engagement will be held at <?php echo '9 St Aubins Ave' ?>.
                    Time: 9AM<br> Place: Germany<br/>

                </div>

            </div>

            <div style="clear:both; margin-top:20px;"></div>
        </div>

    </body>
</html>
