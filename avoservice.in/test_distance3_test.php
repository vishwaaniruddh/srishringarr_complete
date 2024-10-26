
<html>
  <head>
    <title>Waypoints in Directions</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

<!--    <link rel="stylesheet" type="text/css" href="./style.css" />-->
    <script type="module" src="./index.js"></script>
  </head>
  
  <style>
      /* Optional: Makes the sample page fill the window. */
html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}

#container {
  height: 100%;
  display: flex;
}

#sidebar {
  flex-basis: 15rem;
  flex-grow: 1;
  padding: 1rem;
  max-width: 30rem;
  height: 100%;
  box-sizing: border-box;
  overflow: auto;
}

#map {
  flex-basis: 0;
  flex-grow: 4;
  height: 100%;
}

#directions-panel {
  margin-top: 10px;
}
  </style>
  <body>
    <div id="container">
      <div id="map"></div>
      <div id="sidebar">
        <div>
         <input type="submit" id="submit" />
        <pre style="flex-grow: 1" id="request"></pre>

<?php 
//========================================
session_start();
include("access.php");
include('config.php');
$session_user = $_SESSION['loginid'];


$engg_id=$_GET['id'];
$date=$_GET['date'];
//echo $date."engg id:".$engg_id; 
//die;
//$engg_id=582;
//$date='12/06/2023';

$qry1 = mysqli_query($con1,"SELECT loginid, latitude, longitude FROM `area_engg` where engg_id='".$engg_id."'");
$engg_det=mysqli_fetch_row($qry1);
$lat_engg=$engg_det[1];
$lng_engg=$engg_det[2];	

$start = "{ lat: ".$lat_engg.", lng: ".$lng_engg."}";

$end = "{ lat: ".$lat_engg.", lng: ".$lng_engg."}";

$qry2 = mysqli_query($con1,"SELECT alert_id FROM `alert_progress` where engg_id='".$engg_det[0]."' and date(responsetime)=STR_TO_DATE('$date','%d/%m/%Y') and responsetime !='0000-00-00 00:00:00' order by responsetime ASC");;

$n = 0;
$loc_latlng= array();;
while($alertid=mysqli_fetch_array($qry2))
{
    echo $alertid[0]."  ";
    $alertqry=mysqli_query($con1,"select * from alert where alert_id='".$alertid[0]."' ");
    $row=mysqli_fetch_row($alertqry);
    
$loc_latlng[]=$row[5].",".$row[27];
   
	if($row[21] ==  'amc')
        $atm=mysqli_query($con1,"select atmid,latitude1, longitude1 from Amc where amcid='".$row[2]."' ");

	elseif($row[21] == 'site')	
        {
	$atm=mysqli_query($con1,"select atm_id,latitude1, longitude1 from atm where track_id='".$row[2]."'");
		}
$result=mysqli_fetch_row($atm);
 $atmid1= $result[0];
 if($result[0] ==''){ $atmid1= $row[2];}
 $atmid[]=$atmid1;
 $n++;

}

//print_r ($atmid);

// print_r ($loc_latlng);

//===================================
?>
        </div>
        <div id="directions-panel"></div>
      </div>
    </div>

    <!-- 
      The `defer` attribute causes the callback to execute after the full HTML
      document has been parsed. For non-blocking uses, avoiding race conditions,
      and consistent behavior across browsers, consider loading using Promises.
      See https://developers.google.com/maps/documentation/javascript/load-maps-js-api
      for more information.
      -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPte3KtFoLYgBej7RuZUCg7PSFqV1ov-o&callback=initMap&v=weekly"
      defer
    ></script>
  </body>
</html>
<script>
function initMap() {
  const directionsService = new google.maps.DirectionsService();
  const directionsRenderer = new google.maps.DirectionsRenderer();
  const map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 23.24615, lng: 77.400 },
    zoom: 10,
  });

  directionsRenderer.setMap(map);
//   directionsDisplay.setPanel(document.getElementById("sidebar"));
  document.getElementById("submit").addEventListener("click", () => {
  calculateAndDisplayRoute(directionsService, directionsRenderer);
  }
  );
}

function calculateAndDisplayRoute(directionsService, directionsRenderer) {
 
  var start = <?php echo $start; ?>;
  var end = <?php echo $end; ?>;
  const origin = end;
  const destination = end;
 // alert("Start Loc: "+origin)
 
  var checkboxArray1 = <?php echo json_encode($loc_latlng); ?>;
  const checkboxArray = checkboxArray1;
  const waypts = [];
  for (let i = 0; i < checkboxArray.length; i++) {
        alert("site Location: "+ checkboxArray[i]);
      waypts.push({
        location: checkboxArray[i],
        stopover: true,
      });
    
  }
const request = {
      origin: origin,
      destination: destination,
      waypoints: waypts,
      optimizeWaypoints: true,
      travelMode: google.maps.TravelMode.DRIVING,
  };
//document.getElementById("request").innerText = JSON.stringify(request,null,2);  
  directionsService
    .route(request)
    .then((response) => {
      directionsRenderer.setDirections(response);

      const route = response.routes[0];
      const summaryPanel = document.getElementById("directions-panel");

      summaryPanel.innerHTML = "";

      // For each route, display summary information.
      var atmid1 = <?php echo json_encode($atmid); ?>;
      const atmid = atmid1;
      
      for (let i = 0; i < route.legs.length; i++) {
        
       // alert("ATM id:" +atmid[i]);
        const routeSegment = atmid[i];

        summaryPanel.innerHTML +=
          "<b>Route Segment: " + routeSegment + "</b><br>";
        summaryPanel.innerHTML += route.legs[i].start_address + "<br> To ";
        summaryPanel.innerHTML += route.legs[i].end_address + "<br>";
        summaryPanel.innerHTML += "<b>Approx. Travel Time: " +route.legs[i].duration.text + "</b><br>";
        summaryPanel.innerHTML += "<b>Distance: " + route.legs[i].distance.text + "</b><br><br>";
      }
    })
    .catch((e) => window.alert("Directions request failed due to " + status));
}

window.initMap = initMap;
</script>

