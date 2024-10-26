<?php
session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Sorry your session has Expired');window.location='../index.php';</script>";
}
else
{
include("config.php");
$id=$_POST['id'];
$br2=array();
$br=$_POST['br'];
$cust_id=$_POST['custid'];
$up=$_POST['up'];
$cdate = date('Y-m-d H:i:s');
$calltype=$_POST['callclose'];
$ctype=$_POST['ctype'];
$etadate=$_POST['etadt'];
$asstid=$_POST['astid'];
$asstname=$_POST['astname'];
$etdt="0000-00-00 00:00:00";



 $tabal=mysql_query("Insert into customer_comment(`comment_id`,`customer_id`,`alert_id`,`comment_date`,`comment`) Values('','".$cust_id."','".$id."','".$cdate."','".$up."')");	




	if($_SESSION['designation']=='2')
          header('Location:success.html?success=You have successfully updated.');
         else
         header('Location:success.html?success=You have successfully updated.');
}

?>