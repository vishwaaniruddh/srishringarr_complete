<?php
include('config.php');
$srchqr=mysqli_query($con1,"select * from new_sales_order where so_trackid='54472'");
$pon=mysqli_fetch_row($srchqr);

$tomail=$pon[11].", boopathy@avoups.com";
$ccmail=$pon[18];


$email=$tomail.",".$ccmail;

$nm="select bank_name,atm_id,cust_id,area,city,address,state,pincode,branch_id from demo_atm where so_id='54472'";

    $atm=mysqli_query($con1,$nm);
$atmdets=mysqli_fetch_row($atm);

$message="<html>";
$message=$message."<table border=1><th>DO No</th><th>DO Date</th><th>Consignee</th><th>Address</th><th>City</th><th>Site/Sol ID</th><th>State</th>";

$message=$message."<tr><td>".$pon[2]."</td><td>".$pon[15]."</td><td>".$atmdets[0]."</td><td>".$atmdets[5]."</td><td>".$atmdets[4]."</td><td>".$atmdets[1]."</td><td>".$atmdets[6]."</td>";
$message=$message."<tr></table></br></br>";


$message=$message."<table border=1><th>Inoce No</th><th>Invoice Date</th><th>Courier Name</th><th>Docket No</th><th>Exp time of Delivery</th><th>Dispatch Date</th><th>Delivery Date</th>";
$message=$message."<tr><td>".$invno."</td><td>".$date1."</td><td>".$cname."</td><td>".$dno."</td><td>".$estdate."</td><td>".$date2."</td><td>".$deldt."</td>";
$message=$message."<tr></table></br></br>";


 
$message=$message."</html>";

$subject="SO UPDATE-".$atmdets[1];
if($email!="")
{
$headers = "From: <AVO-eAccounts@avoservice.in>\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
		mail($email, $subject, $message, $headers);


}else
{
$error++;
}
?>