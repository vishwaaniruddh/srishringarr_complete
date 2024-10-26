<?php
include("config.php");
$id=$_GET['id'];
$qry=mysqli_query($con1,"select status,loginid,email_id from area_engg where engg_id='".$id."'");
$row=mysqli_fetch_row($qry);
if($row[0]=='1')
{

$qry2=mysqli_query($con1,"update area_engg set status='0' where engg_id='".$id."'");

$qry3=mysqli_query($con1,"Update login set status='0' where srno='".$row[1]."' ");
}
elseif($row[0]=='0')
{
$subject = 'Your Login Details for AVOUPS';
			
			$headers = "From: " .Avoups. "\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$login=mysqli_query($con1,"select username,password from login where srno='".$row[1]."'");		
	$logro=mysqli_fetch_row($login);
	$message="UserID: ".$logro[0]." Password: ".$logro[1];
$to=$row[2];
mail($to, $subject, $message, $headers);
$qry2=mysqli_query($con1,"update area_engg set status='1' where engg_id='".$id."'");
$qry3=mysqli_query($con1,"Update login set status='1' where srno='".$row[1]."' ");
}
if($qry2 && $qry3)
echo "0";
else
echo "1";


?>