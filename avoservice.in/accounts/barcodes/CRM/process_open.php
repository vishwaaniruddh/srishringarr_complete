<?php
include('config.php');
$id=$_POST['id'];
$feedback=$_POST['feedback'];
$cdate=$_POST['cdate'];
$amount=$_POST['amount'];
$status=$_POST['status'];
$client=$_POST['client'];
$pid=$_POST['pid'];
$type=$_POST['type'];

$sql="update phppos_request set paid_amount=paid_amount+'$amount',feedback='$feedback',status='$status',complete_date=STR_TO_DATE('".$cdate."','%d/%m/%Y'),client='$client' where id='$id'";
$result=mysql_query($sql);

$sql1="insert into feedback (id,person_id,feedback,type,fdate) values ('$id','$pid','$feedback','$type',CURDATE())";
$result1=mysql_query($sql1);

if($result && $result1)
{
	header('Location: open.php');
}
else
echo "Error Inserting Data";
?>