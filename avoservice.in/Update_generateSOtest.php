<?php
include("config.php");
$poid="19821";
$typ="1";

//echo $typ;
$var_update="test reason";

$error='0';

echo "select * from pending_installations where id='".$poid."'";
$srchqr=mysqli_query($con1,"select * from pending_installations where id='".$poid."'");
$pon=mysqli_fetch_array($srchqr);
//$eml=$pon[17];
$email="rahull.1612@gmail.com";
	//echo "select bankname,atmid,cid,area,city,address,state,pincode from Amc where po='".$pon[0]."'";
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
$message=$message."Update-<b>".$var_update."</b>";
 
$message=$message."</html>";

//echo $message;
$subject="SO UPDATE";
$headers = "From: <Accounts@avoservice.in>\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
		mail($email, $subject, $message, $headers);





?>