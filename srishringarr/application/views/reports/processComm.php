<?php
ini_set( "display_errors", 0);

include('config.php');


$mobile=$_POST['mobile'];
$name=$_POST['name'];
$amt=$_POST['amount'];
$paid_date=$_POST['paid_date'];
$acc=$_POST['acc'];
$cname=$_POST['cname'];

 // echo $sql="insert into `commission_paid`(name,mobile,amount,paid_date) values('$name','$mobile','$amt',STR_TO_DATE('".$paid_date."','%d/%m/%Y'))" ;
 $sql=mysql_query("insert into `commission_paid`(name,mobile,amount,paid_date) values('$name','$mobile','$amt',STR_TO_DATE('".$paid_date."','%d/%m/%Y'))");
 
 if($sql){
	 //echo "INSERT INTO `bank_transaction`(`trans_id`, `bank_id`, `trans_type`, `trans_amt`, `trans_date`, `trans_memo`, `reconcile`,`enrty_date`) VALUES ('','".$acc."','payment','".$amt."',STR_TO_DATE('".$paid_date."','%d/%m/%Y'),'commission  payment to customer $cname','NO',now())";
		
		$t3=mysql_query("INSERT INTO `bank_transaction`(`trans_id`, `bank_id`, `trans_type`, `trans_amt`, `trans_date`, `trans_memo`, `reconcile`,`enrty_date`) VALUES ('','".$acc."','payment','".$amt."',STR_TO_DATE('".$paid_date."','%d/%m/%Y'),'commission  payment to customer $cname','NO',now())");	
			}

header('location:../../../application/views/reports/commReport.php');



?>