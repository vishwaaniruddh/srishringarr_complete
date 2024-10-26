<?php
session_start();
include('config.php');
 $cust=$_POST['cust'];
 $type=$_POST['type'];
$service=$_POST['servicetype'];
$pordr=$_POST['po'];
$atm=$_POST['atm'];
$area=$_POST['area'];
$pincode=$_POST['pin'];
$city=$_POST['city'];
$state=$_POST['state'];
$addr=$_POST['address'];
$ref=$_POST['ref'];
 $dateget=$_POST['dt'];
 
$bomno=$_POST['bomno'];
$bomdate=$_POST['bomdate'];
$indentno=$_POST['indentno'];
$indentdate=$_POST['indentdate'];
$ed=$_POST['ed'];
$vat=$_POST['vat'];
$dono=$_POST['dono'];
$freight=$_POST['freight'];
$cphone=$_POST['cphone'];
$cemail=$_POST['cemail'];
$req=$_POST['req'];

 
//$dtstr=STR_TO_DATE('".$dateget."','%Y/%m/%d');
//echo $dtstr;
 //$dtrep=str_replace("/","-",$dateget);

//echo "INSERT INTO  atm(atm_id,bank_name,area,pincode,city,state,address,ref_id,po,cust_id,servicetype,podate,state1)  VALUES('$atm','$bank','$area','$pincode','$city','$state','$addr','".$ref."','$pordr','$cust','".$service."',STR_TO_DATE('".$dateget."','%d/%m/%Y'),'$addr')";
if($type=='sales')
{
//echo "INSERT INTO local_site(atm_id,bank_name,area,pincode,city,state,address,ref_id,po,cust_id,servicetype,podate,state1,cphone,cemail)  VALUES('$atm','$bank','$area','$pincode','$city','$state','$addr','".$ref."','$pordr','$cust','".$service."',STR_TO_DATE('".$dateget."','%d/%m/%Y'),'$state','$cphone','$cemail')";

$result= mysqli_query($con1,"INSERT INTO local_site(atm_id,area,pincode,city,state,address,ref_id,po,cust_id,servicetype,podate,state1,cphone,cemail)  VALUES('$atm','$area','$pincode','$city','$state','$addr','".$ref."','$pordr','$cust','".$service."',STR_TO_DATE('".$dateget."','%d/%m/%Y'),'$state','$cphone','$cemail')");
 $id=mysqli_insert_id();
 if(!$result)
 	mysqli_error();

if($result){
		//echo "INSERT INTO `local_instdetails`(`atm_id`, `bomno`, `bomdate`, `indentno`, `indentdate`, `vat`, `ed`, `dono`, `freight`) VALUES ('".$id."','".$bomno."',STR_TO_DATE('".$bomdate."','%d/%m/%Y'),'".$indentno."',STR_TO_DATE('".$indentdate."','%d/%m/%Y'),'".$vat."','".$ed."','".$dono."','".$freight."')";
		$qry=mysqli_query($con1,"INSERT INTO `local_instdetails`(`atm_id`, `bomno`, `bomdate`, `indentno`, `indentdate`, `vat`, `ed`, `dono`, `freight`) VALUES ('".$id."','".$bomno."',STR_TO_DATE('".$bomdate."','%d/%m/%Y'),'".$indentno."',STR_TO_DATE('".$indentdate."','%d/%m/%Y'),'".$vat."','".$ed."','".$dono."','".$freight."')");
//echo "select srno from login where username='".$_SESSION['user']."'";
$qry2=mysqli_query($con1,"select srno from login where username='".$_SESSION['user']."'");
$qry2ro=mysqli_fetch_row($qry2);
$qrr=mysqli_query($con1,"select * from alertlocal where entry_date LIKE ('".date('Y-m-d')."%')");
	$num=mysqli_num_rows($qrr);
	$num2=$num+1;
	if($num2>0 && $num2<=9)
	$num3="0".$num2;
	else
	$num3=$num2;
	//echo "<br/>"."Insert into alertlocal(`cust_id`,`atm_id`,`bank_name`,`area`,`address`,`city`,`state`,`pincode`,`problem`,`caller_name`,`caller_phone`,`caller_email`,`alert_date`,`call_status`,`alert_type`,`po`,`state1`,`buyback`,`createdby`,`subject`,`custdoctno`,entry_date) Values('".$id."','".$atm."','".$bank."','".$area."','".$addr."','".$city."','".$state."','".$pincode."','".$req."','".$cust."','".$cphone."','".$cemail."','".date('Y-m-d')."','Pending','new','".$pordr."','".$state."','','L".$qry2ro[0]."_".date("ymd").$num3."','New Installation Call','','".date('Y-m-d H:i:s')."')";
	if(qry2){
$complain="L".$qry2ro[0]."_".date("ymd").$num3;
		$query=mysqli_query($con1,"Insert into alertlocal(`cust_id`,`atm_id`,`bank_name`,`area`,`address`,`city`,`state`,`pincode`,`problem`,`caller_name`,`caller_phone`,`caller_email`,`alert_date`,`call_status`,`alert_type`,`po`,`state1`,`buyback`,`createdby`,`subject`,`custdoctno`,entry_date) Values('".$id."','".$atm."','".$bank."','".$area."','".$addr."','".$city."','".$state."','".$pincode."','".$req."','".$cust."','".$cphone."','".$cemail."','".date('Y-m-d')."','1','new','".$pordr."','".$state."','','L".$qry2ro[0]."_".date("ymd").$num3."','New Installation Call','','".date('Y-m-d H:i:s')."')");
		 $alert_id=mysqli_insert_id();
		}
		else
			echo mysqli_error();
	if(!$qry)
 		echo mysqli_error();
}

$check=$_POST['check'];
$assets=$_POST['assets'];
$qty=$_POST['qty'];
$warranty=$_POST['warranty'];
$rate=$_POST['rate'];
//print_r($qty);

for($i=0;$i<sizeof($check);$i++)
{
	if(isset($check[$i]))
	{
		//echo "select assets_name assets where assets_id='".$check[$i]."'";
		$asset_name_qry=mysqli_query($con1,"select assets_name from assets where assets_id='".$check[$i]."'");
		$asset_name=mysqli_fetch_array($asset_name_qry);
		//echo "insert into `localsite_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid,type,rate)values('$id','$pordr','".$asset_name[0]."','".$assets[$i]."','".$warranty[$i]."','".$qty[$i]."','".$atm."','NEW','".$rate[$i]."')";
		$result1= mysqli_query($con1,"insert into `localsite_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid,type,rate)values('$id','$pordr','".$asset_name[0]."','".$assets[$i]."','".$warranty[$i]."','".$qty[$i]."','".$atm."','NEW','".$rate[$i]."')");
		$qry3=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$assets[$i]."'");	
		$assets_spec=mysqli_fetch_row($qry3);
		$result2=mysqli_query($con1,"INSERT INTO `alert_assetslocal`(`alert_id`, `po`, `assets`, `qty`, `valid`, `pm`) VALUES ('".$alert_id."','".$pordr."','".$asset_name[0]." (".$assets_spec[0].")','".$qty[$i]."','".$warranty[$i]."','".$service."')");
		if(!$result1 || !$result2)
 			mysqli_error();
	}
}
}
/*
elseif($type=="AMC")
{
	//echo "INSERT INTO Amc(po,cid,atmid,bankname,area,pincode,city,state,address,Ref_id,servicetype,state1)VALUES('$pordr','$cust','$atm','$bank','$area','$pincode','$city','$state','$addr','$ref','".$service."','$state')";

$result= mysqli_query($con1,"INSERT INTO Amc(po,cid,atmid,bankname,area,pincode,city,state,address,Ref_id,servicetype,state1)VALUES('$pordr','$cust','$atm','$bank','$area','$pincode','$city','$state','$addr','$ref','".$service."','$state')");
 $id=mysqli_insert_id();
 $dt=str_replace("/","-",$dateget);
// echo $dt;
 $start=date('Y-m-d', strtotime($dt));
 //echo $start;
 //echo "INSERT INTO `satyavan_accounts`.`amcpurchaseorder` (`id`, `cid`, `po`, `startdt`, `expdt`,`amcsiteid`) VALUES (NULL, '".$cust."', '".$pordr."', '".$start."','".date('Y-m-d', strtotime("+12 months $start"))."','".$id."')";
  $qry=mysqli_query($con1,"INSERT INTO `amcpurchaseorder` (`id`, `cid`, `po`, `startdt`, `expdt`,`amcsiteid`) VALUES (NULL, '".$cust."', '".$pordr."', '".$start."','".date('Y-m-d', strtotime("+12 months $start"))."','".$id."')");
  if(!$result)
echo "".mysqli_error();
$today = strtotime($dt);

if($service=='3')
{
	
	for($i=1;$i<=4;$i++)
	{
		//echo $i."<br>";
	$j=$service*$i;
	//echo "<br>Insert into servicemonth(`po`,`date`,`type`,`siteid`) Values('".$pordr."','".date("Y-m-d",strtotime("+".$j." months", $today))."','AMC','".$id."')<br>";
	$q=mysqli_query($con1,"Insert into servicemonth(`po`,`date`,`type`,`siteid`) Values('".$pordr."','".date("Y-m-d",strtotime("+".$j." months", $today))."','AMC','".$id."')");
	if(!$q)
	echo "failed".mysqli_error();
	}
}
elseif($service=='6')
{
	
	for($i=1;$i<=2;$i++)
	{
		//echo $i."<br>";
	$j=$service*$i;
	//echo "<br>Insert into servicemonth(`po`,`date`,`type`,`siteid`) Values('".$pordr."','".date("Y-m-d",strtotime("+".$j." months", $today))."','AMC','".$id."')<br>";
	$q=mysqli_query($con1,"Insert into servicemonth(`po`,`date`,`type`,`siteid`) Values('".$pordr."','".date("Y-m-d",strtotime("+".$j." months", $today))."','AMC','".$id."')");
	if(!$q)
	echo "failed".mysqli_error();
	}
}
	
	if($upsno>0)
	{
	
//echo "insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid) values('$cust','$pordr','UPS','".$ups."','".$upsno."','".$id."')";
$insert=mysqli_query($con1,"insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid) values('$cust','$pordr','UPS','".$ups."','".$upsno."','".$id."')");
	}
	
	if($btryno>0)
	{
	
//echo "insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid) values('$cust','$pordr','Battery','".$btry."','".$btryno."','".$id."')";
$insert=mysqli_query($con1,"insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid) values('$cust','$pordr','Battery','".$btry."','".$btryno."','".$id."')");
	}
	
	if($isotno>0)
	{
	
//echo "insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid) values('$cust','$pordr','Isolation Transformer','".$isot."','".$isotno."','".$id."')";
$insert=mysqli_query($con1,"insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid) values('$cust','$pordr','Isolation Transformer','".$isot."','".$isotno."','".$id."')");
	}
	
	if($stabno>0)
	{
	
//echo "insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid) values('$cust','$pordr','Stabilizer','".$stab."','".$stabno."','".$id."')";
$insert=mysqli_query($con1,"insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid) values('$cust','$pordr','Stabilizer','".$stab."','".$stabno."','".$id."')");
	}
	
	 if($avrno>0)
	{

	//echo "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid)values('$cust','$pordr','Stabilizer','".$stab."','".$stabwr."','".$stabno."','".$atm."')";
	
	$insert=mysqli_query($con1,"insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid) values('$cust','$pordr','AVR','".$avr."','".$avrno."','".$id."')");
	 }
	if(!$insert)
		 echo "failed".mysqli_error();
}
*/
?>
<script type="text/javascript">
alert("Complain Id : <?php echo $complain; ?>");
window.location='newinstalation_local.php';
</script>