<?php
include("config.php");
$_POST['ref']=526403;
$_POST['type']='amc';
    if($_POST['type']=='site')
	$at=mysqli_query($con1,"select atm_id,latitude,longitude,address,city,state1 from atm where track_id='".$_POST['ref']."'");
	elseif($_POST['type']=='amc')
	$at=mysqli_query($con1,"select atmid,latitude,longitude,address,city,state from Amc where amcid='".$_POST['ref']."'");
	
	$atro=mysqli_fetch_row($at);
	if($atro[1]==0.0000000000)
	{
        $address=$atro[3].','.$atro[4].','.$atro[5];
        $formattedAddr = str_replace(' ','+',$address);
        //Send request and receive json data by address
        $geocodeFromAddr = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($formattedAddr).'&sensor=false&key=AIzaSyCBE1Xgn2mQmGOtUevIuFYw6443BkKCjbI'); 
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
        
        if($_POST['type']=='site')
	           mysqli_query($con1,"update atm set latitude='".$latitude."',longitude='".$longitude."' where track_id='".$_POST['ref']."'");
	    elseif($_POST['type']=='amc')
	           mysqli_query($con1,"update Amc set latitude='".$latitude."',longitude='".$longitude."' where amcid='".$_POST['ref']."'");
        
	}
    else
    {
        $latitude=$atro[1]; 
        $longitude=$atro[2];
    }
    
   // $longitude = (float) 80.5908223000;
   // $latitude = (float) 25.6170441000;
    //$radius = 20; // in miles
      $radius = 25*0.621371192; // in km

    $lng_min = $longitude - $radius / abs(cos(deg2rad($latitude)) * 69);
    $lng_max = $longitude + $radius / abs(cos(deg2rad($latitude)) * 69);
    $lat_min = $latitude - ($radius / 69);
    $lat_max = $latitude + ($radius / 69);
    
    $qry="SELECT *,(6371 * acos( cos( radians($latitude) ) 
              * cos( radians( latitude ) ) 
              * cos( radians( longitude ) - radians($longitude) ) 
              + sin( radians($latitude) ) 
              * sin( radians( latitude ) ) ) ) AS distance FROM engg_current_location WHERE (longitude BETWEEN $lng_min AND $lng_max) AND (latitude BETWEEN $lat_min and $lat_max) ORDER BY distance";
    
    echo $qry;
    
    $res=mysqli_query($con1,$qry);
    
    while($row=mysqli_fetch_row($res)){
        echo '<br>'.$row[0].'-'.$row[1].'-'.$row[2].'-'.$row[3].'-'.$row[4].'-'.$row[5];
    }
?>