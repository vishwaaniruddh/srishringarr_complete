<?php
include('config.php');
$i=0;
$qry=mysqli_query($con1,"select * from `TABLE 139`");
	while($row=mysqli_fetch_array($qry)){
	
	
	
	//$amc_ups=mysqli_query($con1,"INSERT INTO `site_assets1`(`assets_name`, `assets_spec`, `cust_id`, `po`, `atmid`, `quantity`,`valid`,`type`) VALUES ('UPS','".$row['ups_cap']."','".$row['cid']."','".$row['po']."','".$row['amcid']."','".$row['no_ups']."','36','NEW')");
	
	if($amc_ups){
	//$amc_bat=mysqli_query($con1,"INSERT INTO `site_assets1`(`assets_name`, `assets_spec`, `cust_id`, `po`, `atmid`, `quantity`,`valid`,`type`) VALUES ('Battery','".$row['battary']."','".$row['cid']."','".$row['po']."','".$row['amcid']."','".$row['no_bat']."','36','NEW')"); 
		
		}

$i++;
}
echo "<br/>".$i;
?>