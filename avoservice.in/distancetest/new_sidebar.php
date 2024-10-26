<? //var_dump($_POST);?>
<html>
  <head>
    <title>Waypoints in Directions</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

<!--    <link rel="stylesheet" type="text/css" href="./style.css" />-->
    <script type="module" src="./../index.js"></script>
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


        </div>
        <div id="directions-panel"></div>
      </div>
    </div>
    <?php 
//========================================
session_start();
include("../access.php");
include('../config.php');
$session_user = $_POST['sess_user'];


// $engg_id=$_GET['id'];

$sqlme=$_POST['qr'];
// echo $sqlme;

$checkdata = $_POST['checkbox'];
$homecheck= $_POST['check1'];
if($homecheck){
    $homec = 1;
}else{
    $homec = 0;
}
// var_dump($_POST); die;

$x = json_encode($checkdata);
$x1 = str_replace( array('[',']','"') , ''  , $x);
$q = explode(',',$x1);
$q1 = "'" . implode ( "', '", $q )."'";

// $w1 = explode('-',$x1);
// var_dump($w1); die;

$sqlme .="and  createdby in ($q1)";

//  echo $sqlme; die;
$table=mysqli_query($con1,$sqlme);

$qry1=mysqli_query($con1,"select srno from login where username='".$session_user."'");

	$row1=mysqli_fetch_row($qry1);
	
	$engr=mysqli_query($con1,"select engg_name,latitude, longitude from area_engg where loginid='".$row1[0]."'");
	
	$engro=mysqli_fetch_row($engr);
	
 $latitude_engg=$engro[1];
 $longitude_engg=$engro[2];	
 
$lock = array();
array_push($lock,$latitude_engg,$longitude_engg);

//=========Engineer= Session User=========

//   print_r($lock);  

$z = array();
$loc_latlng= array();
$n = 0;
while($row=mysqli_fetch_row($table))
{
    $idd = $row[2];

$loc_latlng[]=$row[5].",".$row[27];

	if($row[21] ==  'amc')
        $atm=mysqli_query($con1,"select atmid,latitude1, longitude1 from Amc where amcid='".$row[2]."' ");

	elseif($row[21] == 'site')	
        {
	$atm=mysqli_query($con1,"select atm_id,latitude1, longitude1 from atm where track_id='".$row[2]."'");
		}
		
 $result=mysqli_fetch_row($atm);
 
 if($result[1] !=0){
 
 $atmid[] = $result[0];
//  print_r($atmid);
 $array = array();
 
//  $array['atmid'] = $result[0];
 $array['lat'] = $result[1];
 $array['lng'] = $result[2];
 $z[$n] = $array;
 
 $n++;
 }
}
// print_r ($z[12]);
$count = count($z)-1;

// print_r($z[$count][lat]);
$loclat = $z[$count][lat];
$loclng = $z[$count][lng];



// $qry1 = mysqli_query($con1,"SELECT loginid, latitude, longitude FROM `area_engg` where engg_id='".$engg_id."'");
// $engg_det=mysqli_fetch_row($qry1);
// $lat_engg=$engg_det[1];
// $lng_engg=$engg_det[2];	

$start = "{ lat: ".$latitude_engg.", lng: ".$longitude_engg."}";

$end = "{ lat: ".$latitude_engg.", lng: ".$longitude_engg."}";

// print_r($start);

//print_r ($atmid);

//print_r ($loc_latlng);

//===================================
?>

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
//   alert("Start Loc: "+origin)
 
  var checkboxArray1 = <?php echo json_encode($loc_latlng); ?>;
  const checkboxArray = checkboxArray1;
//   alert(checkboxArray.length); 
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

