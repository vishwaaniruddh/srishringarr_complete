<?php 
include('config.php');

$id=$_POST['findid'];
$name=$_POST['findname'];

$sql="update findings set finding ='".$name."' where find_id='".$id."'";

$result=mysql_query($sql);
if($result)
{
	
header("location: home.php");

}
else
echo "error Inserting data";
?>