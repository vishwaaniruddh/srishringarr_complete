<?php
include('config.php');
$bank_id=$_GET['bank_id'];
$payment=0;
$income=0;
$qrybal=mysql_query("SELECT * FROM `bank_transaction` where `bank_id`='$bank_id'");
while($resbal=mysql_fetch_row($qrybal))
{
	if($resbal[2]=="payment" || $resbal[2]=="banktrans")
	{
		$payment+=$resbal[3];	
	}
	else if($resbal[2]=="receit")
	{
		$income+=$resbal[3];	
	}
}
$balance=$income-$payment;
echo $balance;

?>