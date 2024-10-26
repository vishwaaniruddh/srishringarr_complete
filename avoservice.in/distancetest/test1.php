<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <title>Multiple Locations using Google Maps </title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPte3KtFoLYgBej7RuZUCg7PSFqV1ov-o&sensor=false"></script>
</head>
<body>
    <div id="googleMap" style="width: 500px; height: 400px;"></div>

    <script type="text/javascript">
    var locationArray = [
      ['Pune', 18.5248904, 73.7228789, 1],
      ['Mumbai', 19.0825223, 72.7410977, 2],
      ['Ahmednagar', 19.1104918, 74.6728675, 3],
      ['Surat', 21.1594627, 77.3507354, 4],
      ['Indore', 22.7242284, 75.7237617, 5]
    ];

    var map = new google.maps.Map(document.getElementById('googleMap'), {
      zoom: 8,
      center: new google.maps.LatLng(18.5248904,73.7228789),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locationArray.length; i++) {
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locationArray[i][1], locationArray[i][2]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locationArray[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
    </script>
</body>
</html>