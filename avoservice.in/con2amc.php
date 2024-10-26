<?php
include("config.php");

$id=$_POST['alert_id'];
$service=$_POST['service'];
$dt=$_POST['adate'];
$amcdate=date('Y-m-d', strtotime(str_replace('/','-',$dt)));

$as_name=$_POST['check'];
$assets=$_POST['assets'];
$qty=$_POST['qty'];
$warranty=$_POST['warranty'];
$rate=$_POST['rate'];

echo $id;

//=============inserting all assets here==================================
	for($a=0;$a<count($_POST['check']);$a++){
		
		//echo "<br>INSERT INTO `amcsite_newinstallation`(`alert_id`, `assets_name`, `spec`, `qty`, `warranty`, `rate`,`amc_date`) VALUES ('".$id."','".$as_name[$a]."','".$assets[$a]."','".$qty[$a]."','".$warranty[$a]."','".$rate[$a]."','".$amcdate."')";
		
//		$query=mysqli_query($con1,"INSERT INTO `amcsite_newinstallation`(`alert_id`, `assets_name`, `spec`, `qty`, `warranty`, `rate`,`amc_date`) VALUES ('".$id."','".$as_name[$a]."','".$assets[$a]."','".$qty[$a]."','".$warranty[$a]."','".$rate[$a]."','".$amcdate."')");
}

//==================== select from tempsites==========================
//echo "<br>select * from tempsites where id='".$id."'";
$qry=mysqli_query($con1,"select * from tempsites where id='".$id."'");
$row=mysqli_fetch_row($qry);

$atmid=explode("_",$row[3]);

$dt=str_replace("/","-",$dt);
	$start=date('Y-m-d', strtotime($dt));

//==================== insert data into  Amc==========================
echo "INSERT INTO `Amc`  (`cid`, `po`, `atmid`, `bankname`, `area`, `pincode`, `city`, `state`, `address`, `refid`,`amc_st_date`, `amc_ex_date`, `cat`, `active`,`branch`) VALUES ('".$row[1]."', '".$row[2]."', '".$atmid[1]."', '".$row[4]."', '".$row[5]."', '".$row[6]."', '".$row[7]."', '".$row[8]."', '".$row[9]."', '".$row[10]."','".$start."', '".date('Y-m-d', strtotime("+12 months $start"))."','A', 'Y','".$row[8]."')";

$qry2=mysqli_query($con1,"INSERT INTO `Amc`  (`cid`, `po`, `atmid`, `bankname`, `area`, `pincode`, `city`, `state`, `address`, `refid`,`amc_st_date`, `amc_ex_date`, `cat`, `active`,`branch`) VALUES ('".$row[1]."', '".$row[2]."', '".$atmid[1]."', '".$row[4]."', '".$row[5]."', '".$row[6]."', '".$row[7]."', '".$row[14]."', '".$row[9]."', '".$row[10]."','".$start."', '".date('Y-m-d', strtotime("+12 months $start"))."','A', 'Y','".$row[8]."')");

	$id2=mysqli_insert_id($con1);
	
	
	
	//echo "<br>".$start;
//==================== insert data into  amcpurchaseorder ==========================
//echo "<br>INSERT INTO `amcpurchaseorder` (`id`, `cid`, `po`, `startdt`, `expdt`,`amcsiteid`) VALUES (NULL, '".$row[1]."', '".$row[2]."', '".$start."','".date('Y-m-d', strtotime("+12 months $start"))."','".$id2."')";
	
	$qry3=mysqli_query($con1,"INSERT INTO `amcpurchaseorder` (`id`, `cid`, `po`, `startdt`, `expdt`,`amcsiteid`) VALUES (NULL, '".$row[1]."', '".$row[2]."', '".$start."','".date('Y-m-d', strtotime("+12 months $start"))."','".$id2."')");
	 

//==================================Service For 3 Moths=================================== 	 
	 if($qry2){
	 
	/* if($service=='3'){
		$j=0;
		for($i=1;$i<=4;$i++){	
		
		$j=$service*$i;
		
		//==================== insert data into  servicemonth ==========================
		//echo "<br>Insert into servicemonth(`po`,`date`,`type`,`siteid`) Values('".$po2."','".date("Y-m-d",strtotime("+".$j." months $start"))."','AMC','".$id2."')<br>";
		$q=mysqli_query($con1,"Insert into servicemonth(`po`,`date`,`type`,`siteid`) Values('".$po2."','".date("Y-m-d",strtotime("+".$j." months $start"))."','AMC','".$id2."')");
		//if(!$q)
		//echo "failed".mysqli_error();
	}
}
//=========================================Service For 6 Month==================================
elseif($service=='6'){	
	for($i=1;$i<=2;$i++){	
	//echo $i."<br>";
	$j=$service*$i;
	//==================== insert data into  servicemonth ==========================
	//echo "<br>Insert into servicemonth(`po`,`date`,`type`,`siteid`) Values('".$po2."','".date("Y-m-d",strtotime("+".$j." months $start"))."','AMC','".$id2."')<br>";
	$q=mysqli_query($con1,"Insert into servicemonth(`po`,`date`,`type`,`siteid`) Values('".$po2."','".date("Y-m-d",strtotime("+".$j." months $start"))."','AMC','".$id2."')");
	//if(!$q)
	//echo "failed".mysqli_error();
	}
}
*/
//==================== Update data into  tempsites ==========================	
//echo  "<br>update tempsites set status='1' where id='".$id."'";

$up=mysqli_query($con1,"update tempsites set status='1' where id='".$id."'");

if($up){
	//header("Location:tempsite.php");
	echo "Data Uploaded Successfully. Please refresh the page to see effect";
	}

}




?>