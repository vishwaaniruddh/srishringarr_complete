<?php 
include 'config.php';
session_start();
$id=$_POST['id'];
$fname=mysqli_real_escape_string($con,$_POST['fname']);
$gender=$_POST['gender'];
$dob=str_replace("/","-",$_POST['dob4']);

$dobf=date("Y-m-d",strtotime($dob));
$age=$_POST['age'];
$address=mysqli_real_escape_string($con,$_POST['add']);
$contact=mysqli_real_escape_string($con,$_POST['cn']);
$sql="";



if($id=="")
{
$sql="insert into staff(name,sex,birth,age,address,telno,name_mem) values('$fname','$gender','$dobf','$age','$address','$contact','')";
}
else
{
	
$sql="update staff set name='".$fname."',sex='".$gender."',birth='dobf',age ='".$age."',address ='".$address."',telno ='".$contact."' where staff_id='".$id."'";	
}

echo $sql;
$result=mysqli_query($con,$sql);
if($result)
{
header("location: add_staff.php");
 }
 else

 {
echo "error Inserting data";
 }
?>