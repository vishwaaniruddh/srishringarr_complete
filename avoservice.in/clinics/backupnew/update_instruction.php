<?php 
include('config.php');

$id=$_POST['id'];
$name=$_POST['act'];

$sql="update ins1 set name='".$name."' where ins_id='".$id."'";

$result=mysql_query($sql);
if($result)
{
	
header("location: view_instruction.php");

}
else
echo "error Updating data";
?>