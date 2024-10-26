<?php
include('config.php');
mysql_query("BEGIN");
$qry=mysql_query("INSERT INTO `bank_transaction_hist`(`trans_id`, `bank_id`, `trans_type`, `trans_amt`, `trans_date`, `trans_memo`, `reconcile`, `reconcile_date`, `enrty_date`, `delete_date`) SELECT `trans_id`, `bank_id`, `trans_type`, `trans_amt`, `trans_date`, `trans_memo`, `reconcile`, `reconcile_date`, `enrty_date`,'".date('Y-m-d H:i:s')."' FROM `bank_transaction` WHERE `trans_id`='".$_REQUEST['trans_id']."'");
$qry1=mysql_query("DELETE FROM `bank_transaction` WHERE `trans_id`='".$_REQUEST['trans_id']."'");
if($qry && $qry1)
{
	mysql_query("COMMIT");
	$_SESSION['success']=1;
}
else
{
	mysql_query("ROLLBACK");
	$_SESSION['success']=0;
}
header('location:bank_report.php');
?>