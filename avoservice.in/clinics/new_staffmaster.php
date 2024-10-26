<?php 
include('config.php');

session_start();

$fname=$_POST['fname'];
$gender=$_POST['gender'];
$dob=$_POST['dob4'];
$age=$_POST['age'];
$address=$_POST['add'];
$contact=$_POST['cn'];
$crel=$_POST['crel'];
$rel=$_POST['rel'];
$mem=$_POST['mem'];
$house=$_POST['house'];
$kids=$_POST['kids'];
$relation=$_POST['relation'];
$amt=$_POST['amt'];
$sal=$_POST['sal'];
$work=$_POST['work'];
$post=$_POST['post'];
$bsal=$_POST['bsal'];
$ot=$_POST['ot'];

$sql="insert into staff_master (name,gender,dob,age,address,contact,close_relative,relation,no_of_mem,house,kids_info,name_mem,expense,salaryexp,daily_hrs,post,basic_sal,ot_rate) values('$fname','$gender','$dob','$age','$address','$contact','$crel','$rel','$mem','$house','$kids','$relation','$amt','$sal','$work','$post','$bsal','$ot')";

$result=mysql_query($sql);
if($result)
{
header("location: home.php");
 }else
echo "error Inserting data";
?>