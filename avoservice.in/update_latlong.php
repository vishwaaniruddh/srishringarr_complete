<?php
include("config.php");
$at=mysqli_query($con1,"select amcid,address,city,state from Amc where active='Y' and latitude1 =0.0 ");

//$at=mysqli_query($con1,"select track_id,address,city,state1 from atm where active='Y' and latitude1 =0.0");

$cnt=mysqli_num_rows($at);
	
$i=0;
	while($i<$cnt)
	{
	$atro=mysqli_fetch_row($at);
	$id=$atro[0];
	
	    $address=$atro[1].','.$atro[2].','.$atro[3];
	   // $address=$atro[1].','.$atro[3];
	    
	   $address=$atro[1];
	  //  $add=explode(',',$address);
	    
	 //   $address=$add[2].",".$add[3].",".$add[4].",".$add[5].",".$atro[2].','.$atro[3];
	//  $address=$add[2].",".$add[3].",".$add[4].",".$add[5];
	    
        $formattedAddr = str_replace(' ','+',$address);
        $formattedAddr=preg_replace('/[ ,]+/', '+', $address);
        //Send request and receive json data by address
//echo $formattedAddr;
        $geocodeFromAddr = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($formattedAddr).'&sensor=false&key=AIzaSyCBE1Xgn2mQmGOtUevIuFYw6443BkKCjbI');
      
         // AIzaSyAyedd7P_KyA4ffIhFVGw6m40LTMXVIbRc //from config
        // AIzaSyCBE1Xgn2mQmGOtUevIuFYw6443BkKCjbI
        $output = json_decode($geocodeFromAddr);
        //Get latitude and longitute from json data
        //$data['latitude']  = $output->results[0]->geometry->location->lat; 
        //$data['longitude'] = $output->results[0]->geometry->location->lng;
        //Return latitude and longitude of the given address
        //print_r($output);
        //echo $data['latitude'];
        //echo $data['longitude'];
        $latitude=$output->results[0]->geometry->location->lat; 
        $longitude=$output->results[0]->geometry->location->lng; 

 mysqli_query($con1,"update Amc set latitude1='".$latitude."',longitude1='".$longitude."' where amcid='".$id."'");
echo $i. "<br>update Amc set latitude1='".$latitude."',longitude1='".$longitude."' where amcid='".$id."'";
 
//  mysqli_query($con1,"update atm set latitude1='".$latitude."',longitude1='".$longitude."' where track_id='".$id."'");
 
	    $i++;
	    
//echo  "<br>update atm set latitude1='".$latitude."',longitude1='".$longitude."' where track_id='".$id."'";
	}
	mysqli_close($con);
?>