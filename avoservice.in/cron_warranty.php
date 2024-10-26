 <?php
include("config.php");

$date=date('Y-m-d');


//=============== Expiry date from Start date====================

$sitedata= mysqli_query($con1,"select site_ass_id, start_date, valid, atmid from site_assets where exp_date= '0000-00-00'");

while($row=mysqli_fetch_row($sitedata)) {
 
$d1=explode(',',$row[2]);
$exp=date('Y-m-d', strtotime("+$d1[0] months $row[1]"));

mysqli_query($con1,"update site_assets set exp_date='".$exp."', status= '1' where site_ass_id='".$row[0]."'"); 

mysqli_query($con1,"update atm set active='Y', expdt='".$exp."' where track_id='".$row[3]."'"); 

} 

//============== Latitude Update=e======

$sitedata= mysqli_query($con1,"select track_id, address,state1 from atm where active='Y' and latitude1='0.0'" );

while($row=mysqli_fetch_row($sitedata)) {

 $address=$row[1].','.$row[2];

        $formattedAddr = str_replace(' ','+',$address);
        $formattedAddr=preg_replace('/[ ,]+/', '+', $address);

$geocodeFromAddr = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($formattedAddr).'&sensor=false&key=AIzaSyCBE1Xgn2mQmGOtUevIuFYw6443BkKCjbI');
         // AIzaSyAyedd7P_KyA4ffIhFVGw6m40LTMXVIbRc //from config
        // AIzaSyCBE1Xgn2mQmGOtUevIuFYw6443BkKCjbI
        $output = json_decode($geocodeFromAddr);
 
        $latitude=$output->results[0]->geometry->location->lat; 
        $longitude=$output->results[0]->geometry->location->lng; 

 mysqli_query($con1,"update atm set latitude1='".$latitude."',longitude1='".$longitude."' where track_id='".$row[0]."'"); 
 echo "<br> update atm set latitude1='".$latitude."',longitude1='".$longitude."' where track_id='".$row[0]."'";

}

mysqli_close($con1);
mysqli_close($con2);
?>