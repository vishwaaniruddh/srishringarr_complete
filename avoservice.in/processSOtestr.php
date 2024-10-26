<?php
session_start();
	include('config.php');
 
$error=0;

	$sid="19836";
 	//echo "cust=".$cust."<br>";
 	$invno=$_POST['invno'];
	$date1=$_POST['date1'];
	$invval=$_POST['invval'];
	$cname=$_POST['cname'];
	$dno=$_POST['dno'];
	$estdate=$_POST['estdate'];
	$date2=$_POST['date2'];
	$crn=$_POST['crn'];
	$crndate=$_POST['crndate'];
	$crnamt=$_POST['crnamt'];
	$crnfile=$_POST['crnfile'];
	$target_dir = "invoices/";
	$target_dir1 = "creditnotes/";
	echo $_POST['invfile'];
$deldt="2017-01-10";
if($_POST['deldt']!="")
{

$daten = str_replace('/', '-', $_POST['deldt']);
$deldt= date('Y-m-d', strtotime($daten));
}


$srchqr=mysqli_query($con1,"select * from pending_installations where id='".$sid."'");
$pon=mysqli_fetch_array($srchqr);
$email=$pon[17];
if($pon[1]=="AMC")
{
$nm="select bankname,atmid,cid,area,city,address,state,pincode,branch from Amc where amcid='".$pon[0]."'";

}
	else{
	
$nm="select  bank_name,atm_id,cust_id,area,city,address,state1,pincode,branch_id from atm where track_id='".$pon[0]."'";
	}

	    $atm=mysqli_query($con1,$nm);
$atmdets=mysqli_fetch_array($atm);

$message="<html>";
$message=$message."<table border=1><th>PO NO</th><th>SO DATE</th><th>BANK NAME</th><th>Address</th><th>SITE ID</th>";
$message=$message."<tr><td>".$pon[2]."</td><td>".$pon[4]."</td><td>".$atmdets[0]."</td><td>".$atmdets[5]."</td><td>".$atmdets[1]."</td>";
$message=$message."<tr></table></br></br>";


$message=$message."<table border=1><th>INVOICE NO</th><th>INVOICE DATE</th><th>COURIER NAME</th><th>DOCKET NO</th><th>ETA</th><th>DISPATCH DATE</th><th>DELIVERY DATE</th>";
$message=$message."<tr><td>".$invno."</td><td>".$date1."</td><td>".$cname."</td><td>".$dno."</td><td>".$estdate."</td><td>".$date2."</td><td>".$deldt."</td>";
$message=$message."<tr></table></br></br>";


 
$message=$message."</html>";

echo $message;


	?>