<?php
include("config.php");

$date=date('Y-m-d');

//=================ATM table=============

$qryvalid = mysqli_query($con1,"select track_id,atm_id, branch_id,latitude1, address,state1 from atm where active='Y' ");

while($row=mysqli_fetch_row($qryvalid)) {

$siteqry= mysqli_query($con1,"select assets_name, exp_date from site_assets where atmid='".$row[0]."' and assets_name ='UPS' order by site_ass_id DESC");

$cnt=mysqli_num_rows($siteqry);
$exp=mysqli_fetch_row($siteqry);

if($cnt == 0 || $exp[1] < $date) {
mysqli_query($con1,"update atm set active='N' where track_id='".$row[0]."'");

}


if($cnt > 0 || $exp[1] > $date) { 
//=============Engineer Mapping=======
$mapdata=mysqli_query($con1,"select * from engg_site_mapping_warr where site_id='".$row[0]."'");
if(mysqli_num_rows($mapdata)==0){

$insert="Insert into engg_site_mapping_warr set site_id='".$row[0]."',atm_id='".$row[1]."' , branch_id='".$row[2]."'";
$ins=mysqli_query($con1,$insert);

    
}

} 
  
}

mysqli_close($con1);
//mysqli_close($con2);

?>