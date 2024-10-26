       <style>
    html {
  height: 100%
}

body {
  height: 100%;
  margin: 0px;
  padding: 0px
}

#map_canvas {
  flex-basis: 0;
  flex-grow: 4;
  height: 50%;
  width:100%;
}

#container {
  height: 100%;
  display: flex;
}

#sidebar {
  flex-basis: 15rem;
  flex-grow: 1;
  padding: 1rem;
  max-width: 50rem;
  height: 100%;
  box-sizing: border-box;
  overflow: auto;
}

#sidebar {
  flex: 0 1 auto;
  padding: 0;
}
#sidebar > div {
  padding: 0.5rem;
}
    
</style>



<script src="https://maps.google.com/maps/api/js?libraries=geometry&key=AIzaSyAPte3KtFoLYgBej7RuZUCg7PSFqV1ov-o"></script>


<html>
    <body>
        <div class="container">
            <div id="map_canvas"></div> 
            <!--<div id="sidebar"></div> -->
            <!--<button type="submit" class="btn btn-primary" name="viewdist" style="text-align:center"></button>-->
           <div id="msg"></div>
        </div>
            <!--<button type="submit" class="btn btn-primary" name="viewdist" style="text-align:center">View Distance</button>-->
        <!--<div id="msg"></div>-->
    </body>
</html>

<?php
session_start();
include("../access.php");
include('../config.php');
$session_user = $_POST['sess_user'];
// echo $session_user;

$sqlme=$_POST['qr'];

$checkdata = $_POST['checkbox'];

$x = json_encode($checkdata);
$x1 = str_replace( array('[',']','"') , ''  , $x);
$q = explode(',',$x1);
$q1 = "'" . implode ( "', '", $q )."'";

// var_dump($q1); die;

$sqlme .="and  createdby in ($q1)";

//  echo $sqlme; die;
$table=mysqli_query($con1,$sqlme);

//=========Engineer= Session User=========
	$qry1=mysqli_query($con1,"select srno from login where username='".$session_user."'");

	$row1=mysqli_fetch_row($qry1);
	
	$engr=mysqli_query($con1,"select engg_name,latitude, longitude from area_engg where loginid='".$row1[0]."'");
	
	$engro=mysqli_fetch_row($engr);
	
 $latitude_engg=$engro[1];
 $longitude_engg=$engro[2];	
 
$lock = array();
array_push($lock,$latitude_engg,$longitude_engg);
//   print_r($lock);  
    
    
    
    
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
// print_r ($z[12]);
$count = count($z)-1;

// print_r($z[$count][lat]);
$loclat = $z[$count][lat];
$loclng = $z[$count][lng];
// echo $loclng;
?>
<!--<form action="checkdistance.php" method="post" >-->
<!--    <input type="hidden" name="id" id="id" value="<?php echo $idd; ?>">-->
<!--    <input type="hidden"  name="sqlme" id="sqlme" value="<?php echo $sqlme; ?>">-->
<!--    <input type="hidden" name="usrname" id="usrname" value="<?php echo $_SESSION['user']; ?>">-->
<!--    <input type="hidden" name="loclat" id="loclat" value="<?php echo $loclat; ?>">-->
<!--    <input type="hidden" name="loclng" id="loclng" value="<?php echo $loclng; ?>">-->
<!--    <input type="hidden" name="homelat" id="homelat" value="<?php echo $latitude_engg; ?>">-->
<!--    <input type="hidden" name="homelong" id="homelong" value="<?php echo $longitude_engg; ?>">-->
<!--    <input type="submit" name="submit" value="Check dist" >-->
<!--</form>-->

<script>

var directionDisplay;
var directionsService = new google.maps.DirectionsService();
var gmarkers = [];
var map = null;
var startLocation = null;
var endLocation = null;
var waypts = null;
var infowindow = new google.maps.InfoWindow({
  size: new google.maps.Size(150, 50)
});


function createMarker(latlng, label,atmid) {
  var contentString = '<b>' + atmid + '</b><br>';
//   var test = 'atmid';
// alert(atmid)
  var marker = new google.maps.Marker({
    position: latlng,
    map: map,
    title: label,
    label: atmid,
    zIndex: Math.round(latlng.lat() * -100000) << 5
  });
  marker.myname = label;
  gmarkers.push(marker);

  google.maps.event.addListener(marker, 'click', function() {
    infowindow.setContent(contentString);
    infowindow.open(map, marker);
  });
  return marker;
}

function haversine_distance(mk1, mk2) {
      var R = 6371.0710; // Radius of the Earth in km
      var rlat1 = mk1.position.lat() * (Math.PI/180); // Convert degrees to radians
      var rlat2 = mk2.position.lat() * (Math.PI/180); // Convert degrees to radians
      var difflat = rlat2-rlat1; // Radian difference (latitudes)
      var difflon = (mk2.position.lng()-mk1.position.lng()) * (Math.PI/180); // Radian difference (longitudes)

      var d = 2 * R * Math.asin(Math.sqrt(Math.sin(difflat/2)*Math.sin(difflat/2)+Math.cos(rlat1)*Math.cos(rlat2)*Math.sin(difflon/2)*Math.sin(difflon/2)));
      return d;
    }


function initialize() {
    var locations = <?php echo json_encode($z); ?>;
    
    var home = <?php echo json_encode($lock); ?>
    
    // alert(locations[0].atmid)
    
  directionsDisplay = new google.maps.DirectionsRenderer({
    suppressMarkers: false,
    DirectionsStep: null,
  
  });
  var bhilai = new google.maps.LatLng(21.152519712328164, 81.32422654288021);
    
  var myOptions = {
    zoom: 6,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    center: bhilai
  }
  map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
  directionsDisplay.setMap(map);
//   directionsDisplay.DirectionsStep(null);
  directionsDisplay.setPanel(document.getElementById("sidebar"));
  calcRoute(locations,home);
}

function calcRoute(locations,home) {
    var total = locations.length;
    alert("total locations: "+total);
    
    const homelocation = new google.maps.LatLng(home[0],home[1]);
    // alert(homelocation)
    
    const start = new google.maps.LatLng(locations[0].lat,locations[0].lng);
     const end =  new google.maps.LatLng(locations[locations.length-1].lat,locations[locations.length-1].lng);
     alert(end)
    var waypts = [];

    for (var loc = 0; loc < locations.length; loc++) {
      waypts.push({
         location:new google.maps.LatLng(locations[loc].lat, locations[loc].lng),
         stopover:true
      }); 
      
    //   var mk1 = {lat:locations[loc].lat,lng:locations[loc].lng},
    //       var mk2 = {lat:locations[loc+1].lat,lng:locations[loc+1].lng}
    //   var mk1 = {lat:locations[loc].lat,lng:locations[loc].lng}
    //   var mk2 = {lat:locations[loc+1].lat,lng:locations[loc+1].lng}
     
    // var mk1 = new google.maps.Marker({position: homelocation, map: map});
    
    if(loc==0){
        var mk1 = new google.maps.Marker({position: homelocation, map: map});
        var mk2 = new google.maps.Marker({position: start, map: map});
    } 
    else if(loc!=0 && loc==locations.length-2){
        var mk1 = new google.maps.Marker({position: start, map: map});
        var mk2 = new google.maps.Marker({position: end, map: map});
    }
    else if(loc==locations.length-1){
        var mk1 = new google.maps.Marker({position: end, map: map});
        var mk2 = new google.maps.Marker({position: homelocation, map: map});
    }
    // var mk1 = new google.maps.Marker({position: start, map: map});
    // var mk2 = new google.maps.Marker({position: end, map: map});
      
    var distance = haversine_distance(mk1,mk2);
    document.getElementById('msg').innerHTML = "Distance between markers: " + distance.toFixed(2) + " Km.";
    };
    
    
  var request = {
    origin: homelocation,
    destination: homelocation,
    waypoints: waypts,
    optimizeWaypoints: true,
    travelMode: google.maps.DirectionsTravelMode.DRIVING
  };
  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
      var route = response.routes[0];
      var bounds = new google.maps.LatLngBounds();
      var route = response.routes[0];
      startLocation = new Object();
      endLocation = new Object();
      var polyline = new google.maps.Polyline({
        path: [],
        strokeColor: '#FF0000',  
        strokeWeight: 3
      });
      
     
      var legs = response.routes[0].legs;
      
      for (i = 0; i < legs.length; i++) {
        if (i == 0) {
          startLocation.latlng = legs[i].start_location;
          startLocation.address = legs[i].start_address;
        } else {
          waypts[i] = new Object();
          waypts[i].latlng = legs[i].start_location;
          waypts[i].address = legs[i].start_address;
        }
        endLocation.latlng = legs[i].end_location;
        console.log("[" + i + "] " + endLocation.latlng.toUrlValue(6));
        endLocation.address = legs[i].end_address;
        var steps = legs[i].steps;
        // console.log(steps);
        
        var distancecheck = legs[i].distance;
        console.log(distancecheck.text);
        // for(var d = 0; d < distancecheck.length; d++ ){
        //      document.getElementById('msg').innerHTML = "Distance between markers: " + distancecheck[d].text + "<br>" ;
        // }
        
        document.getElementById('msg').innerHTML = "Distance between markers: " + distancecheck[i].text + "<br>" ;
       
        
        var durationcheck = legs[i].duration;
        console.log(durationcheck);
        
        for (j = 0; j < steps.length; j++) {
          var nextSegment = steps[j].path;
        //   console.log(nextSegment);
          for (k = 0; k < nextSegment.length; k++) {
            polyline.getPath().push(nextSegment[k]);
            bounds.extend(nextSegment[k]);
          }
        }
      }
    //   var atmid = locations[i].atmid;
      
      var waypoints = polyline.GetPointsAtDistance(10000);
      
      for (var i = 0; i < waypoints.length; i++) {
        //   alert(locations[i].atmid)
        createMarker(waypoints[i], "" + (i + 1),locations[i].atmid);
        
        
      }
    } else {
      alert("directions response " + status);
    }
  });
}
google.maps.event.addDomListener(window, 'load', initialize);

// === A method which returns an array of GLatLngs of points a given interval along the path ===
google.maps.Polyline.prototype.GetPointsAtDistance = function(metres) {
  var next = metres;
  var points = [];
  // some awkward special cases
  if (metres <= 0) return points;
  var dist = 0;
  var olddist = 0;
  for (var i = 1;
    (i < this.getPath().getLength()); i++) {
    olddist = dist;
    dist += google.maps.geometry.spherical.computeDistanceBetween(this.getPath().getAt(i), this.getPath().getAt(i - 1));
    while (dist > next) {
      var p1 = this.getPath().getAt(i - 1);
      var p2 = this.getPath().getAt(i);
      var m = (next - olddist) / (dist - olddist);
      points.push(new google.maps.LatLng(p1.lat() + (p2.lat() - p1.lat()) * m, p1.lng() + (p2.lng() - p1.lng()) * m));
      next += metres;
    }
  }
  return points;
}
    
</script>