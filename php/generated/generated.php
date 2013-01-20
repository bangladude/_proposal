<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');


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
    if (!$row) {
        //die("No such page exists");
    }
}
?>

<html>
    <head>
        <title>Proposal App</title>
        <link type="text/css" rel="stylesheet" href="style.css">
        <link href='//fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=Cabin+Condensed' rel='stylesheet' type='text/css'>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script>$(document).ready(function() {
                setTimeout(function() {
                    $('#imboxDAD').fadeOut(function() {
                        $('#imbox').html("").append('<div id="story"/>');
                        $('#story').html("Our Story is long and filled with sorrow. But it all ends well!");
                        $('#imbox').fadeIn();
                    });
                }, 3500);

            });</script>
    </head>
    <body>
        <div id="title">We are Engaged!</div>
        <div id = "leftbar">
            <img id="coupleimg" style="height:400px; width:auto;" src="<?php echo $row['imgurl']; ?>">
        </div>

        <div id="rightbar">
            <div id="upper">
                <iframe width="400" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"  src= "<?php echo $row['mapurl'] ?>"></iframe>
            </div>

            <div id="lower">
                <p style="color:#aaa; font-size:30px; font-family:'Helvetica';">Love is composed of a single soul inhabiting two bodies.</p>
            </div>

        </div>

        <div id="heading" style="font-size:22px">
            <?php echo $row['my_name'] . ' and ' . $row['o_name'] ?>
            wish to share their engagement with you.<br>
            Our story is one of true love. Though many of you did not even hear that we were dating, this is something we have been considering long and hard.
            In celebration of our lives soon to begin together I would like to invite you to an <b style="color:aaa;"> engagement party </b> at the premises on the map above. We're there right now, just waiting for you.
            <br>
            See you soon,<br>
            All our love.

        </div>

        <div style="text-align:center; margin:auto;">


        </div>

        <div style="clear:both; margin-top:20px;"></div>
    </div>

</body>
</html>
