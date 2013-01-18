<?php
require_once('fb/facebook.php');

$config = array(
    'appId' => '115538591892230',
    'secret' => '25302a5a33d08ecd3f3a21a9f738a12a',
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

<script type="text/javascript">
function fblogin(){
        FB.init()
	FB.api('/me', function(response){
	$("#fbid").attr("value",response.id);
	document.forms["loginform"].submit();
	});

}
</script>

</head>

<body>


   <div id="fb-root">
       <script>
        window.fbAsyncInit = function() {
          FB.init({
            appId      : '115538591892230',
            status     : true, 
            cookie     : true,
            xfbml      : true
          });
        };
        (function(d){
           var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
           js = d.createElement('script'); js.id = id; js.async = true;
           js.src = "//connect.facebook.net/en_US/all.js";
           d.getElementsByTagName('head')[0].appendChild(js);
         }(document));
      </script>
</div>
<div class="fb-login-button" onlogin="fblogin();" perms="email">Login with Facebook</div>
 
 
 <a href="#" onclick="FB.logout();">Logout of Facebook</a>
 





</body>
</html>
