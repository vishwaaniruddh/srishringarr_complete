<?php
include("../access.php");
include('../config.php');

// $id= $_POST['id'];
$sqlme = $_POST['sqlme'];
// $username = $_POST['usrname'];
$loclat=$_POST['loclat'];
$loclng=$_POST['loclng'];
$homelat = $_POST['homelat'];
$homelng = $_POST['homelong'];
// echo $loclat;

// echo $id;
// echo $sqlme;
// echo $username;
$table=mysqli_query($con1,$sqlme);


//=========Engineer= Session User=========
	$qry1=mysqli_query($con1,"select srno from login where username='".$_SESSION['user']."'");

	$row1=mysqli_fetch_row($qry1);
	
	$engr=mysqli_query($con1,"select engg_name,latitude, longitude from area_engg where loginid='".$row1[0]."'");
	
	$engro=mysqli_fetch_row($engr);
	
 $latitude_engg=$engro[1];
 $longitude_engg=$engro[2];	
 
$lock = array();
array_push($lock,$latitude_engg,$longitude_engg);

$z = array();
$n = 0;
while($row=mysqli_fetch_row($table))
{
    $idd = $row[2];

	if($row[21] ==  'amc')
        $atm=mysqli_query($con1,"select atmid,latitude1, longitude1 from Amc where amcid='".$row[2]."' ");

	elseif($row[21] == 'site')	
        {
	$atm=mysqli_query($con1,"select atm_id,latitude1, longitude1 from atm where track_id='".$row[2]."'");
		}
		
 $result=mysqli_fetch_row($atm);
 
 if($result[1] !=0){
 
 $array = array();
 
 $array['atmid'] = $result[0];
 $array['lat'] = $result[1];
 $array['lng'] = $result[2];
 $z[$n] = $array;
 
 $n++;
 }
}


// print_r($z);
// initMap();
?>

<br>


<!DOCTYPE html>
<html>
  <head>
    <style>
       /* Set the size of the div element that contains the map */
      #map {
        height: 400px;
        width: 600px;
       }
    </style>
  </head>
  <body>
    <!--The div elements for the map and message -->
    <div id="map"></div>
    <div id="msg"></div>
    <script>
// Initialize and add the map
var map;

function haversine_distance(mk1, mk2) {
      var R = 6371.0710; // Radius of the Earth in km
      var rlat1 = mk1.position.lat() * (Math.PI/180); // Convert degrees to radians
      var rlat2 = mk2.position.lat() * (Math.PI/180); // Convert degrees to radians
      var difflat = rlat2-rlat1; // Radian difference (latitudes)
      var difflon = (mk2.position.lng()-mk1.position.lng()) * (Math.PI/180); // Radian difference (longitudes)

      var d = 2 * R * Math.asin(Math.sqrt(Math.sin(difflat/2)*Math.sin(difflat/2)+Math.cos(rlat1)*Math.cos(rlat2)*Math.sin(difflon/2)*Math.sin(difflon/2)));
      return d;
    }


function initial(){
    var location = <?php echo json_encode($z); ?>;
    console.log(location[0].atmid);
    
}

function initMap() {
   
  // The map, centered on Central Park
  const center = {lat: 21.152519712328164, lng: 81.32422654288021};
  const options = {zoom: 12, scaleControl: true, center: center};
  map = new google.maps.Map(
      document.getElementById('map'), options);
      
  // Locations of landmarks
//   const bhilai = {lat: 21.152519712328164, lng: 81.32422654288021};
//   const raipur = {lat: 21.217754149148618, lng: 81.63206235634682};
    
    let homelat = <?php echo $homelat;?>;
    let homelng = <?php echo $homelng;?>;
    
    let loclat = <?php echo $loclat;?>;
    let loclng = <?php echo $loclng;?>;
    
    // alert(loclat)
    
    const start = {lat: homelat, lng: homelng };
    const end = {lat: loclat, lng: loclng };
    // alert(end.lng)
  
  // The markers for The bhilai and The raipur Collection
  var mk1 = new google.maps.Marker({position: start, map: map});
  var mk2 = new google.maps.Marker({position: end, map: map});
  
  // Draw a line showing the straight distance between the markers
//   var line = new google.maps.Polyline({path: [bhilai, raipur], map: map});
  
  // Calculate and display the distance between markers
  var distance = haversine_distance(mk1, mk2);
  document.getElementById('msg').innerHTML = "Distance between markers: " + distance.toFixed(2) + " Km.";
  
  let totaldistance = "Distance between markers: " + distance.toFixed(2) + " Km."
  
  let directionsService = new google.maps.DirectionsService();
  let directionsRenderer = new google.maps.DirectionsRenderer();
  directionsRenderer.setMap(map); // Existing map object displays directions
  // Create route from existing points used for markers
  const route = {
      origin: start,
      destination: end,
      travelMode: 'DRIVING',
     
  }

  directionsService.route(route,
    function(response, status) { // anonymous function to capture directions
      if (status !== 'OK') {
        window.alert('Directions request failed due to ' + status);
        return;
      } else {
        directionsRenderer.setDirections(response); // Add route to the map
        var directionsData = response.routes[0].legs[0]; // Get data about the mapped route
        // alert(directionsData);
        if (!directionsData) {
          window.alert('Directions request failed');
          return;
        }
        else {
          document.getElementById('msg').innerHTML += " Driving distance is " + directionsData.distance.text + " (" + directionsData.duration.text + ").";
        }
      }
    });
}

    </script>
    <!--Load the API from the specified URL -- remember to replace YOUR_API_KEY-->
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPte3KtFoLYgBej7RuZUCg7PSFqV1ov-o&callback=initMap">
    </script>
  </body>
</html>