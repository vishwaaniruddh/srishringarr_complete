<?php
include("config.php");

$date=date('Y-m-d');

 $amcdata=mysqli_query($con1,"select amcid,atmid,amc_ex_date, amc_st_date, branch, latitude1,address, state from Amc ");

while($row=mysqli_fetch_row($amcdata))
{
 $start=$row[3];
  $exp=$row[2]; //date('Y-m-d', strtotime("+$d1[0] months $row[2]"));
  
  
 if($exp < $date or $start > $date){
     echo "update Amc set active='N' where amcid='".$row[0]."'";
  mysqli_query($con1,"update Amc set active='N' where amcid='".$row[0]."'");
  
  }
  elseif($exp > $date && $start <= $date)
  {
//echo "Active";
echo "update Amc set active='Y' where amcid='".$row[0]."'";
mysqli_query($con1,"update Amc set active='Y' where amcid='".$row[0]."'");



//=============Engineer Mapping=======
/* $mapdata=mysqli_query($con1,"select * from engg_site_mapping where site_id='".$row[0]."'");
if(mysqli_num_rows($mapdata)==0){

$insert="Insert into engg_site_mapping set site_id='".$row[0]."',atm_id='".$row[1]."' , branch_id='".$row[4]."'";
//echo $insert;
$ins=mysqli_query($con1,$insert);
}  */



}
} 

//====Latitude update==========

/*$at=mysqli_query($con1,"select amcid,address,city,state from Amc where active='Y' and latitude1 =0.0 ");

$cnt=mysqli_num_rows($at);
echo $cnt;

$i=0;
	while($i<$cnt)
	{
	$atro=mysqli_fetch_row($at);
	$id=$atro[0];
	
	    $address=$atro[1].','.$atro[2].','.$atro[3];
	   // $formattedAddr=$address;
      //  $formattedAddr = str_replace(' ','+',$address);
        $formattedAddr=preg_replace('/[ ,]+/', '+', $address);
        //Send request and receive json data by address
//echo "<br>".$formattedAddr;
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
//echo  "<br>update Amc set latitude1='".$latitude."',longitude1='".$longitude."' where amcid='".$id."'";

	    $i++;
	} */

mysqli_close($con1);

?>