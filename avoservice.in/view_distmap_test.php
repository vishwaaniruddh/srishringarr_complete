
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

#floating-panel {
  position: absolute;
  top: 10px;
  left: 25%;
  z-index: 5;
  background-color: #fff;
  padding: 5px;
  border: 1px solid #999;
  text-align: center;
  font-family: "Roboto", "sans-serif";
  line-height: 30px;
  padding-left: 10px;
}

#floating-panel {
  background-color: #fff;
  border: 0;
  border-radius: 2px;
  box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
  margin: 10px;
  padding: 0 0.5em;
  font: 400 18px Roboto, Arial, sans-serif;
  overflow: hidden;
  padding: 5px;
  font-size: 14px;
  text-align: center;
  line-height: 30px;
  height: auto;
}

#map {
  flex: auto;
}

#sidebar {
  flex: 0 1 auto;
  padding: 0;
}
#sidebar > div {
  padding: 0.5rem;
}
</style>

<?php
session_start();
include("access.php");
include('config.php');
$sqlme=$_POST['qr'];

$table=mysqli_query($con1,$sqlme);

//=========Engineer= Session User=========
	$qry1=mysqli_query($con1,"select srno from login where username='".$_SESSION['user']."'");

	$row1=mysqli_fetch_row($qry1);
	
	$engr=mysqli_query($con1,"select engg_name,latitude, longitude from area_engg where loginid='".$row1[0]."'");
	
	$engro=mysqli_fetch_row($engr);
	
 $latitude_engg=$engro[1];
 $longitude_engg=$engro[2];	
    
$z = array();
$n = 0;
while($row=mysqli_fetch_row($table))
{


	if($row[21] ==  'amc')
        $atm=mysqli_query($con1,"select atmid,latitude1, longitude1 from Amc where amcid='".$row[2]."'");

	elseif($row[21] == 'site')	
        {
	$atm=mysqli_query($con1,"select atm_id,latitude1, longitude1 from atm where track_id='".$row[2]."'");
		}
		
 $result=mysqli_fetch_row($atm);
 $numrows = mysqli_num_rows($result); 

 
 $latitude_site=$result[1];
 $latitude_site=$result[2];
 
 $array = array();
 
 $array['atmid'] = $result[0];
 $array['lat'] = $result[1];
 $array['lng'] = $result[2];
 $z[$n] = $array;
 $n++;
 
}	
//  echo '<pre>';print_r($result);echo '</pre>';die;
 
//  print_r (json_encode($z)); 
?>
<html>
    <head>
         <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
         <title>MAps </title>
    </head>
    <body>
        <!--<div id="floating-panel"></div>-->
        <div class="container">
            <div id = "map"></div>
            <div id="sidebar"></div>
        </div>

    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPte3KtFoLYgBej7RuZUCg7PSFqV1ov-o&callback=initMap&v=weekly" defer></script>
    <script>
function initMap() {
    debugger;
    var locationsb = <?php echo json_encode($z); ?>;
    
    // var starting = []; var ending = [];
    // for(var k = 0;k<locationsb.length;k++){
    //     const startpoint =  new google.maps.LatLng(locationsb[k].lat,locationsb[k].long);
    //     const endpoint =  new google.maps.LatLng(locationsb[k+1].lat,locationsb[k+1].long);
        
    //     // alert(startpoint);
    //     starting.push(startpoint);
    //     ending.push(endpoint);
    // }
    
    // for(var a=0;a<starting.length;a++){
    //     for(var b=0;b<ending.length;b++)
    //     {
            
    //     }
    // }
        
    // alert(end)
    // console.log(dist);
    // alert(dist);
    
    // let lat1 = locationsb[5].lat;
    // let long1 = locationsb[5].long;
    
    // // alert(lat1)
    // let lat2 = locationsb[6].lat;
    // let long2 = locationsb[6].long;

    // const start = new google.maps.LatLng(lat1,long1);
    // const end = new google.maps.LatLng(lat2,long2);
    
    // var latlong = []; var startp = []; var endp = []; 
    // for(var k = 0;k<locationsb.length;k++){
     
    //      const startpoint =  new google.maps.LatLng(locationsb[k].lat,locationsb[k].long);
    //      const endpoint =  new google.maps.LatLng(locationsb[k+1].lat,locationsb[k+1].long);
         
    //     startp.push(startpoint);
        
    //     alert(startp);
    //     // console.log(startp);
    //     // startp.push(endpoint); 
    //     // alert(startp);
        
    //     // latlong.push(endpt);
         
    //     // alert(endpoint)
    //     //var coord =  new google.maps.LatLng(locationsb[k].lat,locationsb[k].long);
    //     // latlong.push(coords);
    //     //alert(coord);
    // }
    // console.log(latlong);
    
    
    
  const directionsRenderer = new google.maps.DirectionsRenderer();
  const directionsService = new google.maps.DirectionsService();
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 7,
    center: { lat: 21.152519712328164, lng: 81.32422654288021 },
    disableDefaultUI: true,
  });
    
  directionsRenderer.setMap(map); 
  directionsRenderer.setPanel(document.getElementById("sidebar"));

    if(locationsb.length>0){
        // calculateAndDisplayRoute(directionsService, directionsRenderer,start,end);
        calculateAndDisplayRoute(directionsService, directionsRenderer,locationsb);
    } else {
        alert("LatLong not available")
    }
}


// function calculateAndDisplayRoute(directionsService, directionsRenderer,start,end) {
function calculateAndDisplayRoute(directionsService, directionsRenderer,locationsb) {    

var marker;
for(var c=0;c<locationsb.length;c++){
    // marker = new google.maps.Marker({
      directionsService
      
    .route({
      origin: new google.maps.LatLng(locationsb[c+1].lat,locationsb[c+1].lng),
      destination: new google.maps.LatLng(locationsb[c+2].lat,locationsb[c+2].lng),
      travelMode: google.maps.TravelMode.DRIVING,
    })
    // alert(origin);
    .then((response) => {
      directionsRenderer.setDirections(response);
    })
      .catch((e) => window.alert("Directions request failed "));
// });
//  google.maps.event.addListener(marker, 'click', (function(marker, c) {
//         return function() {
//           infowindow.setContent(locationsb[c][0]);
//           infowindow.open(map, marker);
//         }
//       })(marker, c));
}


//   .catch((e) => window.alert("Directions request failed "));
//   directionsService
//     .route({
//       origin: start,
//       destination: end,
//       travelMode: google.maps.TravelMode.DRIVING,
//     })
//     .then((response) => {
//       directionsRenderer.setDirections(response);
//     })
//     .catch((e) => window.alert("Directions request failed "));
}

window.initMap = initMap;
    </script>
    </body>
</html>