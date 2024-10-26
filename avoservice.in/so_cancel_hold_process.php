<?php
session_start();
include('config.php');

$sts=$_POST['sts'];
$id=$_POST['id'];
$reason=mysqli_real_escape_string($_POST['reas']);

$err=0;
mysqli_query($con1,"BEGIN");

$instrack=mysqli_query($con1,"INSERT INTO `so_cancel_hold_track_new`(`so_id`, `so_status`, `updtby`, `updt_dt`,updtby_name,reason) VALUES ('".$id."','".$sts."','".$_SESSION['logid']."','".date("Y-m-d H:i:s")."','".$_SESSION['user']."','".$reason."')");

if(!$instrack)
{
$err++;
}

$qrstr="update sales_orders set status='".$sts."' where id='".$id."'";
//echo $qrstr;
$qr=mysqli_query($con1,$qrstr);
if(!$qr)
{
$err++;
}

if($err==0)
{
mysqli_query($con1,"COMMIT");

echo "1";
}else
{
mysqli_query($con1,"ROLLBACK");

echo "0";
}


?>