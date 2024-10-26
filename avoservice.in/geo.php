<?php

include('config.php');

//$center_lat = $_GET["lat"];
//$center_lng = $_GET["lng"];
//$radius = $_GET["radius"];

// Start XML file, create parent node
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

/*$query = sprintf("SELECT address, name, lat, lng, ( 3959 * acos( cos( radians('%s') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( lat ) ) ) ) AS distance FROM markers HAVING distance < '%s' ORDER BY distance LIMIT 0 , 20",
  mysqli_real_escape_string($center_lat),
  mysqli_real_escape_string($center_lng),
  mysqli_real_escape_string($center_lat),
  mysqli_real_escape_string($radius));*/
  
$result = mysqli_query($con1,"select * from Location where mac_address='3a696d9cab21bc25' and dt>'2020-06-11 00:00:00'");

//$result = mysqli_query($con1,$query);
if (!$result) {
  die("Invalid query: " . mysqli_error());
}

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each
while ($row = @mysqli_fetch_assoc($result)){
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("time", $row['dt']);
//  $newnode->setAttribute("address", $row['address']);
  $newnode->setAttribute("lat", $row['latitude']);
  $newnode->setAttribute("lng", $row['longitude']);
 // $newnode->setAttribute("distance", $row['distance']);
}

echo $dom->saveXML();
?>