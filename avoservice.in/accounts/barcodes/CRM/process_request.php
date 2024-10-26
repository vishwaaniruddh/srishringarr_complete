<?php
include('config.php');
$cname=$_POST['cname'];
$req=$_POST['req'];
$assign=$_POST['assign'];
$amount=$_POST['amount'];
$type=$_POST['type'];
$sql="insert into phppos_request (person_id,request,request_date,assign_to,amount,cust_type) values ('$cname','$req',CURDATE(),'$assign','$amount','$type')";
//echo $sql;
$result=mysql_query($sql);

if($result)
{
	header('Location: cust_request.php');
}
else
echo "Error Inserting Data";
?>