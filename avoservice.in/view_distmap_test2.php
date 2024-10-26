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
  height: 100%;
}
    
</style>



<script src="https://maps.google.com/maps/api/js?libraries=geometry&key=AIzaSyAPte3KtFoLYgBej7RuZUCg7PSFqV1ov-o"></script>
<!--<script src="epoly.js" type="text/javascript"> </script>-->
<!--<div id="map_canvas"></div>-->

<html>
    <body>
        <div id="map_canvas"></div>
    </body>
</html>

<?php
session_start();
include("access.php");
include('config.php');
$sqlme=$_POST['qr'];

// echo $sqlme;
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
?>

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


//  var total = locations.length;
 
//  alert(total);
//  for(var i=0;i<locations.length;i++){
    
//      var start =  new google.maps.LatLng(locations[i].lat,locations[i].lng);
//      var end =  new google.maps.LatLng(locations[total].lat,locations[total].lng);
     
//      alert(start);
   
//  }

function createMarker(latlng, label, html, color) {
  var contentString = '<b>' + label + '</b><br>' + html;
  var marker = new google.maps.Marker({
    position: latlng,
    map: map,
    title: label,
    label: label,
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

function initialize() {
    var locations = <?php echo json_encode($z); ?>;
    
  directionsDisplay = new google.maps.DirectionsRenderer({
    suppressMarkers: true
  });
  var bhilai = new google.maps.LatLng(21.152519712328164, 81.32422654288021);
    
  var myOptions = {
    zoom: 6,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    center: bhilai
  }
  map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
  directionsDisplay.setMap(map);
  calcRoute(locations);
}

function calcRoute(locations) {
    // var total = locations.length;
    // alert(total);
    
    //  for(var i=0;i<locations.length;i++){
    
//      var start =  new google.maps.LatLng(locations[i].lat,locations[i].lng);
//      var end =  new google.maps.LatLng(locations[total].lat,locations[total].lng);
     
//      alert(start);
   
//  }

    
    
  var request = {
    origin: "Bicknacre",
    destination: "Bicknacre",
    waypoints: [{
      location: new google.maps.LatLng(51.744915, 0.573389),
      stopover: false
    }, {
      location: new google.maps.LatLng(51.775197, 0.592035),
      stopover: false
    }, {
      location: new google.maps.LatLng(51.731653, 0.665789),
      stopover: false
    }, {
      location: new google.maps.LatLng(51.671305, 0.714838),
      stopover: false
    }, {
      location: new google.maps.LatLng(51.65319, 0.601305),
      stopover: false
    }],
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
        for (j = 0; j < steps.length; j++) {
          var nextSegment = steps[j].path;
          for (k = 0; k < nextSegment.length; k++) {
            polyline.getPath().push(nextSegment[k]);
            bounds.extend(nextSegment[k]);
          }
        }
      }
      var waypoints = polyline.GetPointsAtDistance(5000);
      for (var i = 0; i < waypoints.length; i++) {
        createMarker(waypoints[i], "" + (i + 1), (i + 1) * 5 + " km");
      }
    } else {
      alert("directions response " + status);
    }
  });
}
google.maps.event.addDomListener(window, 'load', initialize);
// ported to v3 from the epoly library by Mike Williams
// http://econym.org.uk/gmap/epoly.htm

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