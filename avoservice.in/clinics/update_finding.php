<?php 
include('config.php');

$id=$_POST['findid'];
$name=$_POST['findname'];

$sql="update finding set name ='".$name."' where id='".$id."'";

$result=mysql_query($sql);
if($result)
{
	
header("location: viewfinding.php");

}
else
echo "error Inserting data";
?>