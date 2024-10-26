<!DOCTYPE html>
<html>
  <head>
    <title>Google Maps Example</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBE1Xgn2mQmGOtUevIuFYw6443BkKCjbI"></script>
    <script>
        var map;
        var marker1;
        var marker2;
        var distance;
  
        function initMap() {
          map = new google.maps.Map(document.getElementById('map'), {
            zoom: 8,
            center: {lat: 21.1938, lng: 81.3509}
          });
          map.addListener('click', function(event) {
            if (!marker1) {
              marker1 = new google.maps.Marker({
                position: event.latLng,
                map: map,
                title: 'Marker 1'
              });
            } else if (!marker2) {
              marker2 = new google.maps.Marker({
                position: event.latLng,
                map: map,
                title: 'Marker 2'
              });
              calculateDistance();
            } else {
              marker1.setPosition(event.latLng);
              marker2.setMap(null);
              marker2 = null;
            }
          });
        }
  
        function calculateDistance() {
          var service = new google.maps.DistanceMatrixService();
          service.getDistanceMatrix({
            origins: [marker1.getPosition()],
            destinations: [marker2.getPosition()],
            travelMode: 'DRIVING',
            unitSystem: google.maps.UnitSystem.METRIC,
            avoidHighways: false,
            avoidTolls: false
          }, function(response, status) {
            if (status !== 'OK') {
              alert('Error was: ' + status);
            } else {
              distance = response.rows[0].elements[0].distance.text;
              var infowindow = new google.maps.InfoWindow({
                content: 'Distance: ' + distance
              });
              infowindow.open(map, marker1);
            }
          });
        }
      </script>
  </head>
  <body onload="initMap()">
    <div id="map" style="height: 1000px; width: 100%;"></div>
  </body>
</html>