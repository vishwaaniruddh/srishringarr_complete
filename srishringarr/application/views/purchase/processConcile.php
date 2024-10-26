<?php
include('config.php');

$trans_id=$_POST['trans_id'];
$concil=$_POST['concil'];
$count=$_POST['count'];
/*echo $frmdate=$_POST['frmdate'];
echo $todate=$_POST['todate'];
echo $bank_id=$_POST['bank_id'];
*///echo count($concil);
//echo count($trans_id);
//print_r($trans_id);
//print_r($concil);
$i=0;$j=0;
$con=array();
while($i<$count)
{
	if(isset($concil[$i]))
	{
		$con[$j]=$concil[$i];	
		$j++;
	}
	$i++;
}
//print_r($con);
//echo "select * from `bank_transaction` where bank_id='$bank_id' and (`trans_date` between STR_TO_DATE('".$frmdate."','%d/%m/%Y') AND  STR_TO_DATE('".$todate."','%d/%m/%Y'))";
$qry=mysql_query("select * from `bank_transaction` where bank_id='$bank_id' and (`trans_date` between STR_TO_DATE('".$frmdate."','%d/%m/%Y') AND  STR_TO_DATE('".$todate."','%d/%m/%Y'))");
while($row=mysql_fetch_row($qry))
{ $flag=0; 
for($i=0;$i<count($con);$i++)
	{
	if($row[0]==$con[$i])
	{
	mysql_query("UPDATE `bank_transaction` SET `reconcile`='Yes',`reconcile_date`=now() WHERE `trans_id`='$con[$i]' AND `trans_id`='$row[0]' ") ;
		$flag=1;
	}
	}//ends for loop
	if($flag==0)
	{
		mysql_query("UPDATE `bank_transaction` SET `reconcile`='No',`reconcile_date`='' WHERE `trans_id`='$row[0]' ") ;	
	}
	}
header('location:../../../index.php/purchase');
?>
