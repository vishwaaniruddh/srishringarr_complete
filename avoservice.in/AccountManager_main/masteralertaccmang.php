<?php
//include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

$id=$_GET['id'];
?>

<html>

<head><title>Engineer Alerts</title>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript">
    var geocoder;
var map;
var infowindow = new google.maps.InfoWindow();
 
/* function to initialize the map */
function initialize(lat,lng) {
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(-34.397, 150.644);
    var mapOptions = {
        zoom: 10,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
}
 
/* Geocoding based on address */
function codeAddress(address, title, imageURL) {
    geocoder.geocode({ 'address': address }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({map: map,position: results[0].geometry.location,icon: imageURL,title: title});
             
            /* Set onclick popup */
            var infowindow = new google.maps.InfoWindow({content: title});
            google.maps.event.addListener(marker, 'click', function() {infowindow.open(marker.get('map'), marker);});
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}
 
/* Geocoding based on latitude and longitude */
function codeLatLng(latlng, title, imageURL) {
    var latlngStr = latlng.split(',', 2);
    var lat = parseFloat(latlngStr[0]);
    var lng = parseFloat(latlngStr[1]);
    var latlng = new google.maps.LatLng(lat, lng);
    geocoder.geocode({ 'latLng': latlng }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[1]) {
                map.setZoom(11);
                marker = new google.maps.Marker({position: latlng,map: map,icon: imageURL,title: title,content: title});
                 
                /* Set onclick popup */
                var infowindow = new google.maps.InfoWindow({content: title});
                google.maps.event.addListener(marker, 'click', function() {infowindow.open(marker.get('map'), marker);});
                 
            } else {
                alert('No results found');
            }
        } else {
            alert('Geocoder failed due to: ' + status);
        }
    });
}
</script>
</head>

<body bgcolor="#009999">
<table border="1" width="100%">
<thead>
<tr>
<th>Update</th>
<th>Date / Time</th>
<th>Engineer Name</th>
<th>Updated From</th>
</tr>
</thead>

<tbody>

<?php
include("config.php");
//echo "select * from eng_feedback  where alert_id='".$id."' order by feed_date DESC";
$tab=mysql_query("select * from eng_feedback  where alert_id='".$id."' order by feed_date DESC");
 while ($row=mysql_fetch_row($tab)) {
	 
	 $qry=mysql_query("select * from login where srno='".$row[2]."'");
	 $rw=mysql_fetch_row($qry);
	
	  ?>
      

     

<tr>
<td><?php echo $row[3]; ?></td>
<td><?php if(isset($row[4]) and $row[3]!='0000-00-00') echo date('d/m/Y h:i:s a',strtotime($row[4])); ?></td>
<td><?php if($rw[1]==''){ echo "Masteradmin";  }else{ echo $rw[1]; } ?></td>
<td><?php echo $row[8]; ?></td>
</tr>
<?php } ?>
</tbody>
</table>

</body>
</html>
