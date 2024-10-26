<?php 
include('config.php');

$id=$_POST['id'];
$name=$_POST['name'];


$sql="update diag set name='".$name."' where dia_id='".$id."'";

$result=mysql_query($sql);
if($result)
{
	
header("location: view_diag.php");

}
else
echo "error Inserting data";
?>