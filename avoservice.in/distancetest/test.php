<!DOCTYPE html>
<html>
<head>
    <title>Routing</title>
    <style>
        html, body, #map-canvas {
    height: 100%;
    width: 100%;
    margin: 0px;
    padding: 0px
}
    </style>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPte3KtFoLYgBej7RuZUCg7PSFqV1ov-o&callback=mapLocation"></script>
    <script>
    function mapLocation() {

    var values = [];


    var directionsDisplay;
    var directionsService = new google.maps.DirectionsService();
    var map;


    function initialize() {
        directionsDisplay = new google.maps.DirectionsRenderer();
        var chicago = new google.maps.LatLng(37.54866603021222, -77.44119330331694);
        var mapOptions = {
            zoom: 10,
            center: chicago
        };
        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        directionsDisplay.setMap(map);
        google.maps.event.addDomListener(document.getElementById('routebtn'), 'click', calcRoute);


        google.maps.event.addListener(map, 'click', function(e) {
        alert(e.latLng.lat() + ", " + e.latLng.lng());
        placeMarker(e.latLng, map);
        console.log(e.latLng)
        values.push({lat:e.latLng.lat(),lng:e.latLng.lng()});
        console.log("values",values);
       /* navigator.geolocation.getCurrentPosition(function(position) {
                var lat = position.coords.latitude;
                var lon = position.coords.longitude;
                values.push(lat, lon);
        });*/

        });
    }

    function placeMarker(position, map) {

        var marker = new google.maps.Marker({
        position: position,
        map: map
        });  


        map.panTo(position);
    }



    function calcRoute() {
        console.log(values);
        var waypoints_data = [];
        var i;


        for(i = 1; i < values.length-1; i++){
            var loc = new google.maps.LatLng(values[i]);
            waypoints_data.push({location:loc,stopover: false}); 
        }


        /*var a = new google.maps.LatLng(values.lat, values.lng);
        //var end = new google.maps.LatLng(38.334818, -181.884886);
        var b = new google.maps.LatLng(values.lat, values.lng);
        /*var c = new google.maps.LatLng(51.50748705717662, -0.13893842697143555);
        var d = new google.maps.LatLng(51.50346856667175, -0.14929282090679408);
        var e = new google.maps.LatLng(51.51083871071007, -0.1570619682540837);
        var f = new google.maps.LatLng(51.51334975342731, -0.15831470489501953);
        var g = new google.maps.LatLng(51.514163869310785, -0.1615037063827458);
        var h = new google.maps.LatLng(51.51796947585254, -0.1516760925521794);
        var i = new google.maps.LatLng(51.519611797295354, -0.1447636425947394);
        var j = new google.maps.LatLng(51.51742202221118, -0.14268224839918275);
        var k = new google.maps.LatLng(51.5138700899723, -0.14141624574415346);
        var l = new google.maps.LatLng(51.50902430327333, -0.12421940501076278);
        /*
var startMarker = new google.maps.Marker({
            position: start,
            map: map,
            draggable: true
        });
        var endMarker = new google.maps.Marker({
            position: end,
            map: map,
            draggable: true
        });
*/
        var bounds = new google.maps.LatLngBounds();
        bounds.extend(values[0]);
        bounds.extend(values[values.length-1]);
        map.fitBounds(bounds);
        var request = {
            origin: values[0],
            destination: values[values.length-1],
            waypoints: waypoints_data,

                        //[{location: a, stopover: false},
                        //{location: b, stopover: false}],
                        /*{location: c, stopover: false},
                        {location: d, stopover: false},
                        {location: e, stopover: false},
                        {location: f, stopover: false},
                        {location: g, stopover: false},
                        {location: h, stopover: false},
                        {location: i, stopover: false},
                        {location: j, stopover: false},
                        {location: k, stopover: false},
                        {location: l, stopover: false}],*/
            optimizeWaypoints: true,
            travelMode: google.maps.TravelMode.DRIVING
        };
        directionsService.route(request, function (response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
                directionsDisplay.setMap(map);
            } else {
                alert("Directions Request from " + values[0].toUrlValue(6) + " to " + values[values.length-1].toUrlValue(6) + " failed: " + status);
            }
        });
    }

    google.maps.event.addDomListener(window, 'load', initialize);
}
mapLocation();
    </script>
</head>
<body>

    <input type="button" id="routebtn" value="route" />
<div id="map-canvas"></div>

</body>
</html>