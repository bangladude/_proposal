<?php

function getAddress($url){
try{	
    $xml = simplexml_load_file();
	$addarr = $xml ->result->children();
	$add = $addarr[2];
	return $add;
}
catch(Exception $e){
    #nothing
}
        
}


function getMapURL(){
	$location = getlocation();
	$location = urlencode($location);
	$url = 'https://maps.googleapis.com/maps/api/place/textsearch/xml?query=' . $location . '%20convention%20center&sensor=false&key=AIzaSyCDhpo3U3LZFhvXbte1-fiCEHaIWOY-lP4';
	$xml = simplexml_load_file($url);
  	$lat = $xml ->result->geometry->location->children();   
	$latlng = $lat[0].",".$lat[1];
	$url2 = "https://maps.google.com/maps?f=q&hl=en&geocode=&time=&date=&type=&iwloc=A&q=" . getAddress($url) . "&center=" . getAddress($url) . "&markers=color:red|size:small|" . $latlng. "&sll=" .$latlng. "&ie=UTF8&ll=" .$latlng. "&output=embed";
	return $url2;
}

function geoCheckIP()
       {
       		   $ip = "94.219.40.96"; 
               //check, if the provided ip is valid
               if(!filter_var($ip, FILTER_VALIDATE_IP))
               {
                       throw new InvalidArgumentException("IP is not valid");
               }

               //contact ip-server
               $response=@file_get_contents('http://www.netip.de/search?query='.$ip);
               if (empty($response))
               {
                       throw new InvalidArgumentException("Error contacting Geo-IP-Server");
               }

               //Array containing all regex-patterns necessary to extract ip-geoinfo from page
               $patterns=array();
               $patterns["domain"] = '#Domain: (.*?)&nbsp;#i';
               $patterns["country"] = '#Country: (.*?)&nbsp;#i';
               $patterns["state"] = '#State/Region: (.*?)<br#i';
               $patterns["town"] = '#City: (.*?)<br#i';

               //Array where results will be stored
               $ipInfo=array();

               //check response from ipserver for above patterns
               foreach ($patterns as $key => $pattern)
               {
                       //store the result in array
                       $ipInfo[$key] = preg_match($pattern,$response,$value) && !empty($value[1]) ? $value[1] : 'not found';
               }
			   return $ipInfo["town"];
               
       }
  

function getlocation(){
	global $user_id, $facebook;
	$location= $facebook->api("/" . $user_id . "?fields=location");
	if (isset($location['location']['name'])) {return $location['location']['name'];}
	else {return geoCheckIP();}
	
    }


function echohtml(){
	echo 'iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo getMapURL()?>"></iframe><br />';
}

?>
