<html>
<?php

function findlatlng($location){
	$location = urlencode($location);
	$url = 'https://maps.googleapis.com/maps/api/place/textsearch/xml?query=' . $location . '%20convention%20center&sensor=false&key=AIzaSyCDhpo3U3LZFhvXbte1-fiCEHaIWOY-lP4';
	$xml = simplexml_load_file($url);
  	$lat = $xml ->result->geometry->location->children();   
	$latlng = $lat[0].",".$lat[1];
	return $latlng;
}

function getlocation(){
	global $user_id;
	$location= $facebook->api("/" . $user_id . "?fields=location");
	return $location;
    }

function createurl(){
	$location = getlocation();
	$coor = findlatlng($location);
	$url = "http://maps.googleapis.com/maps/api/staticmap?size=512x512&maptype=roadmap\&markers=size:mid%7Ccolor:red%7C" . $coor . "&sensor=false";
	return $url;
}
?>

<img width="300" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo createurl(); ?>" />
<br />
<small>
<a href="<?php echo createurl(); ?>" style="color:#0000FF;text-align:left">View Larger Map</a>
</small>

</html>