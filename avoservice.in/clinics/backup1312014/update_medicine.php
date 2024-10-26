<?php 
include('config.php');

$id=$_POST['id'];
$name=$_POST['name'];


$sql="update medicine set name='".$name."' where med_id='".$id."'";

$result=mysql_query($sql);
if($result)
{
	
header("location: viewmedicines.php");

}
else
echo "error Inserting data";
?>