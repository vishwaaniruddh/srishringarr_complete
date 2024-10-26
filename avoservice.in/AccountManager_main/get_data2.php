<?php

include('config.php');

//$ref=$_GET['ref'];
$qry="";
$atm=$_GET['atm'];
$type=$_GET['type'];

//echo $atm;
//if($ref=="df"){
//echo "SELECT `cid`,`bankname`,`state`,`city`,`address`,`pincode`,`area`,`servicetype` FROM `atm` WHERE `ref_id`='$var[0]'";
if($type=='amc')
{
	echo "SELECT `cid`,`bankname`,`state`,`city`,`address`,`pincode`,`area`,`servicetype` FROM `Amc` WHERE `amcid`='$atm'";
$qry=mysql_query("SELECT `cid`,`bankname`,`state`,`city`,`address`,`pincode`,`area`,`servicetype` FROM `Amc` WHERE `amcid`='$atm'");
//echo "SELECT `cid`,`bankname`,`state`,`city`,`address`,`pincode`,`area`,`servicetype` FROM `Amc` WHERE `ref_id`='$atm'";;
}
elseif($type=='site')
{
$qry=mysql_query("SELECT `cust_id`,`bank_name`,`state`,`city`,`address`,`pincode`,`area`,`servicetype` FROM `atm` WHERE `track_id`='$atm'");
//echo "SELECT `cust_id`,`bank_name`,`state`,`city`,`address`,`pincode`,`area`,`servicetype` FROM `atm` WHERE `ref_id`='$atm'";//
}

if(!$qry)
echo mysql_error();
$row = mysql_fetch_row($qry);
//echo $row[4];
		
$str=$row[0]."#".$row[1]."#".$row[2]."#".$row[3]."#".$row[4]."#".$row[5]."#".$row[6];


					
echo $str;
?>