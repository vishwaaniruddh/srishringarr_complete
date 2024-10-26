<?php 
include('config.php');

$id=$_POST['compid'];
$name=$_POST['compname'];

$sql="update compla set name ='".$name."' where id='".$id."'";

$result=mysql_query($sql);
if($result)
{
	
header("location: home.php");

}
else
echo "error Inserting data";
?>