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


function initMap() {
    // const labels = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  // The map, centered on Central Park
  const center = {lat: 21.152519712328164, lng: 81.32422654288021};
  const options = {zoom: 12, scaleControl: true, center: center};
  map = new google.maps.Map(
      document.getElementById('map'), options);
      
  // Locations of landmarks
  const bhilai = {lat: 21.152519712328164, lng: 81.32422654288021};
  const raipur = {lat: 21.217754149148618, lng: 81.63206235634682};
  // The markers for The bhilai and The raipur Collection
  var mk1 = new google.maps.Marker({position: bhilai, map: map});
  var mk2 = new google.maps.Marker({position: raipur, map: map});
  
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
      origin: bhilai,
      destination: raipur,
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