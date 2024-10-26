<?php
include('config.php');
$bank_name=$_POST['bank_name'];
$ac_no=$_POST['ac_no'];
$address=$_POST['address'];
$openbal=$_POST['openbal'];
$overdraft=$_POST['over'];
$actype=$_POST['actype'];

$bankqry=mysql_query("INSERT INTO `banks`(`bank_id`, `bank_name`, `ac_no`, `address`, `date_added`, `ac_type`, `overdraft`) VALUES ('','$bank_name','$ac_no','$address',now(),'$actype','$overdraft')");
if($bankqry)
{	
	$qryid=mysql_query("select max(bank_id) from banks");
	$bank_id=mysql_fetch_row($qryid);
	//echo $bank_id[0];
		$transqry=mysql_query("INSERT INTO `bank_transaction`(`trans_id`, `bank_id`, `trans_type`, `trans_amt`, `trans_date`, `trans_memo`, `reconcile`) VALUES ('','$bank_id[0]','receit','$openbal',now(),'opening Balance','NO')");
		if($transqry)
		{
				echo "Bank Added Successfully. <a href='newbank.php'> Add Another Bank</a> "	;
		}	
		else
		{
			echo "Bank Transaction Failed. Reinsert Opening Balance. <a href='bank_entry.php'>Make Transaction</a> ";
		}
}
else
echo "Error in Inserting Data ".mysql_error()."<a href='newbank.php'></a>
";
?>