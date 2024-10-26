<?php
include 'config.php';
$paydtf="0000-00-00";
if($_POST['paydt']!="")
{
       $paydt=str_replace("/","-",$_POST['paydt']);
     $paydtf=date("Y-m-d",strtotime($paydt));
} 
	 $payto=$_POST['payto'];
	$pay=$_POST['pay'];
	$desc=mysqli_real_escape_string($con,$_POST['desc']);
	$amt=$_POST['amt'];
	
	
	
$qr=mysqli_query($con,"INSERT INTO `payment_dets`(`pay_to`, `pay_id`, `amt`, `descr`,pay_dt) VALUES ('".$payto."','".$pay."','".$amt."','".$desc."','".$paydtf."')");
if($qr)
{
	
	header("location:payment.php?st=1");
}
else
{
	header("location:payment.php?st=2");
	
}

?>