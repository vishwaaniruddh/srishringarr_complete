<?php
include('../config.php');
 $cust=$_POST['cust'];
 $site=$_POST['site'];
$service=$_POST['servicetype'];
$pordr=$_POST['po'];
$atm=$_POST['atm'];
$bank=$_POST['bank'];
$area=$_POST['area'];
$pincode=$_POST['pin'];
$city=$_POST['city'];
$state=$_POST['state'];
$addr=$_POST['address'];
$ref=$_POST['ref'];
 $dateget=$_POST['dt'];
 
 $atmid=$_POST['atmid'];
 //echo "hi".  $atmid ."<br>";
 
//$dtstr=STR_TO_DATE('".$dateget."','%Y/%m/%d');
//echo $dtstr;
 //$dtrep=str_replace("/","-",$dateget);
  $ups=$_POST['ups'];
 $upsno=$_POST['upsno'];
 $upswr=$_POST['upswr'];
 $btry=$_POST['btry'];
 $btryno=$_POST['btryno'];
$btrywr=$_POST['btrywr'];
$isot=$_POST['isot'];
$isotno=$_POST['isotno'];
$isotwr=$_POST['isotwr'];
$stab=$_POST['stab'];
$stabno=$_POST['stabno'];
$stabwr=$_POST['stabwr'];


$cusid=mysql_query("select cust_id from customer where cust_name='".$cust."'");
$custid=mysql_fetch_row($cusid);
//print_r( $custid)."<br>";

if($upsno>0)
	{

             //echo "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid,type)values('".$custid[0]."','".$pordr."','UPS','".$ups."','".$upswr."','".$upsno."','".$atmid."','".$site."')<br>";
	
	$result1= mysql_query("insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid,type)values('".$custid[0]."','".$pordr."','UPS','".$ups."','".$upswr."','".$upsno."','".$atmid."','".$site."')");
	 }
	 
	  if($btryno>0)
	 {

	//echo "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid,type)values('".$custid[0]."','$pordr','Battery','".$btry."','".$btrywr."','".$btryno."','".$atm."','".$site."')<br>";
	
	$result1= mysql_query("insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid,type)values('".$custid[0]."','".$pordr."','Battery','".$btry."','".$btrywr."','".$btryno."','".$atmid."','".$site."')");
	 }
	  if($isotno>0)
	{

	//echo "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid,type)values('".$custid[0]."','$pordr','Isolation Transformer','".$isot."','".$isotwr."','".$isotno."','".$atm."','".$site."')<br>";
	
	$result1= mysql_query("insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid,type)values('".$custid[0]."','".$pordr."','Isolation Transformer','".$isot."','".$isotwr."','".$isotno."','".$atmid."','".$site."')");
	 }
	 if($stabno>0)
	{

	  //echo "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid,type)values('".$custid[0]."','$pordr','Stabilizer','".$stab."','".$stabwr."','".$stabno."','".$atm."','".$site."')<br>";
	
	$result1= mysql_query("insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid,type)values('".$custid[0]."','".$pordr."','Stabilizer','".$stab."','".$stabwr."','".$stabno."','".$atmid."','".$site."')");
	 }
	 if(!$result1)
	 echo mysql_error();
	 
?>
		
<script>
alert("PO Generated successfully");
window.location='view_amc.php';
</script>
