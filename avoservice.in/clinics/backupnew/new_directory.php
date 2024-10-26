<?php 
include('config.php');

session_start();

$name=$_POST['name'];
$address=$_POST['add'];
$city=$_POST['city'];
$contact=$_POST['cn'];
$pincode=$_POST['pin'];
$info=$_POST['info'];
$ncity=$_POST['ncity'];


if($city=='Other' && $ncity!=''){$city=$ncity;
if($city!='Other'){
$cy=mysql_query("insert into city(name) values ('$city')");
}
}

$sql="insert into address(name,office,city,mobile,pincode,category) values('$name','$address','$city','$contact','$pincode','$info')";

$result=mysql_query($sql);
if($result)
{
header("location: telephone.php");
 }else
echo "error Inserting data";
?>