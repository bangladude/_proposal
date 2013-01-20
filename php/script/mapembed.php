<?php


function getMapURL(){
	$location = getlocation();
	$location = urlencode($location);
	$url = 'https://maps.googleapis.com/maps/api/place/textsearch/xml?query=' . $location . '%20convention%20center&sensor=false&key=AIzaSyCDhpo3U3LZFhvXbte1-fiCEHaIWOY-lP4';
	$xml = simplexml_load_file($url);
  	$lat = $xml ->result->geometry->location->children();   
	$latlng = $lat[0].",".$lat[1];
	$addarr = $xml ->result->children();
	$add = $addarr[2];
	$url2 = "https://maps.google.com/maps?f=q&hl=en&geocode=&time=&date=&ttype=&q=" . $add . "&center=" .$add. "&markers=color:red|size:small|" . $latlng. "&sll=" .$latlng. "&ie=UTF8&ll=" .$latlng. "&output=embed";
	return $url2;
}

function getlocation(){
	global $user_id, $facebook;
	$location= $facebook->api("/" . $user_id . "?fields=location");
	return $location['location']['name'];
    }


function echohtml(){
	echo 'iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo getMapURL()?>"></iframe><br />';
}

?>
