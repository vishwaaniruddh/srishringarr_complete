<?php 
include 'config.php';


$name=$_POST['name'];
$add=$_POST['add'];
$city=$_POST['city'];
$contact=$_POST['cn'];
$gen=$_POST['gen'];
$spl=$_POST['spl'];
$mobile=$_POST['mobile'];
$cat=$_POST['cat'];
$email=$_POST['email'];
$remarks=$_POST['rem'];
$country=$_POST['country'];
$sql="insert into doctor (name,address,city,telno,gender,special,category,email,mobile,remarks,country) values('$name','$add','$city','$contact','$gen','$spl','$cat','$email','$mobile','$remarks','$country')";

$result=mysqli_query($con,$sql);
if($result)
{
	//echo $id;
header("location: home.php");

}
else
echo "error Inserting data";
?>