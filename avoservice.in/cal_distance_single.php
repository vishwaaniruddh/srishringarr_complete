<?php
include('config.php');
// update location a,notification_tble b set a.engg_id=b.pid where a.mac_address=b.mac_id
function distance($lat1, $lon1, $lat2, $lon2, $unit) {
  if (($lat1 == $lat2) && ($lon1 == $lon2)) {
    return 0;
  }
  else {
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
      return ($miles * 1.609344);
    } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
      return $miles;
    }
  }
}
//echo "hi";
$date='2020-11-01';

$result=mysqli_query($con1,"SELECT engg_id FROM `area_engg` where status=1 and deleted=0 and engg_id=839");
echo mysqli_num_rows($result)."<br>";
$cnt=1;
while($row=mysqli_fetch_row($result))
{
    $res=mysqli_query($con1,"SELECT latitude,longitude,mac_address,dt FROM `Location` where engg_id='".$row[0]."' and latitude>'0.000000' and longitude>'0.000000' and dt BETWEEN '".$date." 05:00:00' and '".$date." 22:00:00' order by id");
    
    $ro=mysqli_fetch_row($res);
    $lat1=$ro[0];
    $lon1=$ro[1];
    $mac=$ro[2];
    
    $tot_distance=0.0;
    
    while($rx=mysqli_fetch_row($res)){
        $lat2=$rx[0];
        $lon2=$rx[1];
        
        $dis=distance($lat1, $lon1, $lat2, $lon2, "K");
        $tot_distance=$tot_distance+$dis;
    //    echo $dis."-".$tot_distance."-".$rx[3]."<br>";
        $lat1=$lat2;
        $lon1=$lon2;
    }
     mysqli_query($con1,"update engg_distances set dis_travelled='".$tot_distance."' where eng_id='".$row[0]."' and dis_date='".$date."'");
    echo $cnt++."<br>";
}
?>