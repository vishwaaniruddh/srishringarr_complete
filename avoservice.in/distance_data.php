<?php
include('config.php');

$rad = M_PI / 180;
//echo $rad.'<br>';
function circle_distance($lat1, $lon1, $lat2, $lon2) {
  
  if (($lat1 == $lat2) && ($lon1 == $lon2)) {
    return 0;
  }
  else {
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    //$unit = strtoupper($unit);

    //if ($unit == "K") {
      return ($miles * 1.609344);
    //} else if ($unit == "N") {
    //  return ($miles * 0.8684);
    //} else {
    //  return $miles;
    //}
  }
 // return acos(sin($lat2*$rad) * sin($lat1*$rad) + cos($lat2*$rad) * cos($lat1*$rad) * cos($lon2*$rad - $lon1*$rad)) * 6371;// Kilometers
}

$qry="SELECT engg_id,latitude,longitude  FROM `area_engg` where branch_id=19 and status=1 and deleted=0 and latitude!=0.00";

$res=mysqli_query($con1,$qry);
 
 while($row=mysqli_fetch_row($res)){
     $lat1=$row[1];
     $lon1=$row[2];
     $eng_id=$row[0];
    //$qry1="SELECT track_id,latitude1,longitude1  FROM `atm` WHERE `branch_id`='19' and active='Y' and latitude1!=0.00";
    $qry1="SELECT AMCID,latitude1,longitude1  FROM `Amc` WHERE `branch`='19' and active='Y' and latitude1!=0.00";
    $res1=mysqli_query($con1,$qry1);
    while($row1=mysqli_fetch_row($res1)){
        $lat2=$row1[1];
     $lon2=$row1[2];
     $atm_id=$row1[0];
        $dist = circle_distance($lat1,$lon1,$lat2,$lon2);
      //echo $lat1.'-'.$lon1.'-'.$lat2.'-'.$lon2.'-'.$dist;  
        mysqli_query($con1,"insert into distance_data_amc(eng_id,atm_id,distance) values('".$eng_id."','".$atm_id."','".$dist."')");
    }
 
 }

 mysqli_close($con);
?>