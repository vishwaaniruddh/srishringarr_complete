<?php 
include('config.php');

$id=$_POST['id'];
$pass=$_POST['act'];

$sql="update login set password='".$pass."' where id='".$id."'";

$result=mysql_query($sql);
if($result)
{
	
header("location: userPassword.php");

}
else
echo "error Updating data";
?>