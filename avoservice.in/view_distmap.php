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


while($row=mysqli_fetch_row($table))
{


	if($row[21] ==  'amc')
        $atm=mysqli_query($con1,"select atmid,latitude1, longitude1 from Amc where amcid='".$row[2]."'");

	elseif($row[21] == 'site')	
        {
	$atm=mysqli_query($con1,"select atm_id,latitude1, longitude1 from atm where track_id='".$row[2]."'");
		}
		
 $result=mysqli_fetch_row($atm);
 
 $latitude_site=$result[3];
 $longitude_site=$result[4];
 
if($latitude_site==0) {
    
    $address=$row[5];
    $city=$row[6];
    $state=$row[27];

//================ Get LATLONG from Address=========


    
}
 
//====Output=============	





}	
?>