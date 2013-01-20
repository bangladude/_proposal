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
                        <img id="coupleimg" src="<?php echo $row['imgurl']; ?>">
                  </div>
		
		<div id="rightbar">
			<div id="upper">
                    <iframe width="600" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"  src= <?php echo .$row['mapurl'] . ?> />
            </div>
			<div id="lower">
                      <p id="lower">Love is composed of a single soul inhabiting two bodies.</p>
                   
            </div>

        </div>
               
        <div id="heading">
        		<?php echo $row['my_name'] . ' and ' . $row['o_name'] ?>
               wish to share their engagement with you. 
        </div>
      
            <div style="text-align:center; margin:auto;">
                

            </div>

            <div style="clear:both; margin-top:20px;"></div>
        </div>

    </body>
</html>
