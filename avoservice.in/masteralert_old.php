<?php
include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
include("config.php");
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
<center><h2>Call Details</h2></center>
<table border='1'>
<?php
$atmidd='';
//echo "select a.createdby,a.cust_id,a.atm_id,a.bank_name,a.address,a.state1,a.problem,a.entry_date,a.alert_type,a.assetstatus,c.cust_name from alert a,customer c where a.alert_id='".$id."' and a.cust_id=c.cust_id";
$alert=mysqli_query($con1,"select a.createdby,a.cust_id,a.atm_id,a.bank_name,a.address,a.state1,a.problem,a.entry_date,a.alert_type,a.assetstatus,c.cust_name from alert190221 a,customer c where a.alert_id='".$id."' and a.cust_id=c.cust_id");
$alertro=mysqli_fetch_row($alert);
//echo $alertro[8]."** ".$alertro[9];
if($alertro[8]!="new temp"){
if($alertro[8]=='service' &&  $alertro[9] ==  'amc')
    $atm=mysqli_query($con1,"select atmid from Amc where amcid='".$alertro[2]."'");
	elseif($alertro[8]=='service' &&  $alertro[9] == 'site')
	$atm=mysqli_query($con1,"select atm_id from atm where track_id='".$alertro[2]."'");
	
	$atmro=mysqli_fetch_row($atm);
	$atmidd=$atmro[0];
	}
	else
	$atmidd=$alertro[2];
?>
<tr><th>Client</th><td><?php echo $alertro[10]; ?></td><th>Atm ID</th><td><?php echo $atmidd; ?></td></tr>
<tr><th>Docket No.</th><td><?php echo $alertro[0]; ?></td><th>Bank</th><td><?php echo $alertro[3]; ?></td></tr>
<tr><th valign="top">Address</th><td valign="top"><?php echo nl2br($alertro[4]); ?></td><th valign="top">Problem</td><td valign="top"><?php echo nl2br($alertro[6]); ?></td></tr>
  <tr>
  <th>Call Delegated to</th>
    <th width="77" colspan="" align="center"><?php
    //echo "select engg_name from area_engg where engg_id=(select engineer from alert_delegation where alert_id='".$id."')";
    $del=mysqli_query($con1,"select engg_name from area_engg where engg_id=(select engineer from `alert_delegation_190221` where alert_id='".$id."')");
    $delro=mysqli_fetch_row($del);
    $eng=$delro[0];
    $del2=mysqli_query($con1,"select engg_name from area_engg where engg_id=(select eng_new from alert_redelegation_190221 where alert_id='".$id."')");
    if(mysqli_num_rows($del2)>0){
    $delro2=mysqli_fetch_row($del2);
    $eng=$delro[0];
    }
    echo $eng;
    ?>
    </th>
    <th>Call Logged On</th><td><?php echo date('d/m/Y h:i:s a',strtotime($alertro[7])); ?></td>
    
  </tr>
</table>
<center><h2>Updates</h2></center>
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

//echo "select * from eng_feedback190221  where alert_id='".$id."' order by feed_date DESC";
$tab=mysqli_query($con1,"select * from eng_feedback190221  where alert_id='".$id."' order by feed_date DESC");
 while ($row=mysqli_fetch_row($tab)) {
	 
	 $qry=mysqli_query($con1,"select * from login where srno='".$row[2]."'");
	 $rw=mysqli_fetch_row($qry);
	
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