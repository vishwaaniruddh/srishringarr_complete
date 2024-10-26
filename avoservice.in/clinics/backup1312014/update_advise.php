<?php 
include('config.php');

$id=$_POST['adviseid'];
$name=$_POST['advisename'];

$sql="update advise set name ='".$name."' where id='".$id."'";

$result=mysql_query($sql);
if($result)
{
	
header("location: viewadvise.php");

}
else
echo "error Inserting data";
?>