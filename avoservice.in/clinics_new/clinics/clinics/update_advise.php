<?php 
include('config.php');

$id=$_POST['adviseid'];
$name=$_POST['advisename'];

$sql="update advise set advise ='".$name."' where advise_id='".$id."'";

$result=mysql_query($sql);
if($result)
{
	
header("location: home.php");

}
else
echo "error Inserting data";
?>