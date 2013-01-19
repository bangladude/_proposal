<?

function postWall() {
    global $facebook, $user_id, $partner;

    echo print_r($partner);
    echo '<br>';
    echo $partner['gender'];
    echo strcmp($partner['gender'], 'male');
    echo strcmp($partner['gender'], 'female');
    echo '<br>';

    $adjectives = explode(',', "n admirable,n aristocratic,n athletic,n august, beautiful, becoming, clean-cut, comely, dapper,n elegant, fair,
        fashionable, fine, good-looking, graceful, impressive, lovely, majestic, noble, personable, pulchritudinous, robust, sharp, smart,
        smooth, spruce, stately, strong, stylish, suave, virile, adorable, agreeable, alluring, beautiful, beckoning, bewitching, 
        captivating, charming, comely, enchanting, engaging, enthralling, enticing, fair, fascinating, fetching, glamorous, good-looking,
        gorgeous, handsome, hunky, interesting, inviting, looker, lovely, luring, magnetic, mesmeric, pleasant, pleasing, prepossessing,
        pretty, provocative, seductive, stunning, taking, tantalizing, teasing, tempting, winning, winsome,
        n admirable,n alluring,n angelic,n appealing, beauteous, bewitching, charming, classy, comely, cute, dazzling, delicate, delightful,
        divine, elegant, enticing, excellent, exquisite, fair, fascinating, fine, foxy, good-looking, gorgeous, graceful, grand, handsome,
        n ideal, lovely, magnificent, marvelous, nice, pleasing, pretty, pulchritudinous, radiant, ravishing, refined, resplendent,
        shapely, sightly, splendid, statuesque, stunning, sublime, superb, symmetrical, taking, well-formed, wonderful");

    $adj = $adjectives[array_rand($adjectives)];

    if (!strcmp($partner['gender'], 'male')) {
        $pnoun = 'guy';
    } else {
        $pnoun = 'girl';
    }

    $publishStream = $facebook->api("/" . $user_id . "/feed", 'post', array(
        'message' => 'I\'m getting engaged to a' . $adj . ' ' . $pnoun . ": " . $partner['name'],
            )
    );
}

function postEvent() {
    global $facebook, $user_id;

    $event_param = array('name' => "Event Name",
        'start_time' => date("c", time() + 60 * 60 * 2),
            //'end_time' => time() + 60 * 60 * 2,
//'location' => "Event Location",
//'description' => "Description",
//'privacy_type' => "OPEN",
    );

    $event_id = $facebook->api("/" . $user_id . "/events", "POST", $event_param);
    echo '<br>Event: ' . $event_id . '<br>';
}

function postPhoto() {
    global $facebook, $user_id, $access_token;

    $facebook->setFileUploadSupport(true);
    $args = array(
        'message' => 'I\'m getting married!!!',
        'image' => '@' . realpath('up.png'),
        "access_token" => $access_token,
    );




// Show photo upload form to user and post to the Graph URL
    $graph_url = "https://graph.facebook.com/" . $user_id . "/photos?"
            . "access_token=" . $access_token;

    $data = $facebook->api('/me/photos', 'post', $args);
    print_r($data);
}

function storeDB() {
    global $facebook, $user_id, $partner;

    $con = mysql_connect("127.4.96.129", "proposal", "telecom"); //connect to db

    if (!$con) { //check for connection
        die("Could not connect: " . mysql_error());
    } else {


        mysql_select_db("proposal", $con);


        mysql_query("SET NAMES utf8");

        $user_profile = $facebook->api('/me', 'GET');
        $fullname = $user_profile['name'];
        $p_name = $partner['name'];
        $url = getPhoto($partner['id']);

        $sql = "INSERT INTO webpages (my_name,o_name,imgurl) VALUES ('$fullname','$p_name')"; //SELECT only the right user

        $result = mysql_query($sql, $con);

        $sql = "SELECT id FROM webpages WHERE my_name='$fullname' AND o_name='$p_name' ORDER BY id DESC";

        echo '<br>' . $sql . '<br>';
        $result = mysql_query($sql, $con);

        $row = mysql_fetch_array($result);

        echo '<br><a href=../generated/generated.php?id=' . $row['id'] . '>Generated Page</a><br>';
    }
}

function getPhoto($user) {
    
    
    
    global $facebook;
    
    $query = "SELECT pid, object_id, images, like_info FROM photo WHERE object_id IN  (SELECT object_id FROM photo_tag WHERE subject=me())";
    $params = array(
        'method' => 'fql.query',
        'query' => $query,
    );

    $result1 = $facebook->api($params);
    echo print_r($result1).'<br>';

    $query2 = "SELECT object_id FROM photo WHERE object_id IN  (SELECT object_id FROM photo_tag WHERE subject= '$user')";
    $params['query'] = $query2;
    $result2 = $facebook->api($params);
    
    
    #echo print_r($result2).'<br>';
    #echo $query2;
    
    $max = -1;
    foreach ($result1 as &$value1) {
        foreach ($result2 as &$value2) {
            
            if ($value1['object_id'] == $value2['object_id']) {
                
                
                $ret = $facebook->api("/" . $value1['object_id'] . "?fields=tags", 'get');
                #echo '<br>'.print_r($ret['tags']['data']).'<br>';
                if (count(($ret['tags']['data'])) != 2) {
                    break;
                }

                if ($value1['like_info']['like_count'] > $max) {
                    $max = $value1['like_info']['like_count'];
                    $final = $value1['images'];
                }
            }
        }
    }

    return $final[0]['source'];
}

?>
