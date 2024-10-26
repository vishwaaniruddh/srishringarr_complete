<?php 
include 'config.php';

//$id=$_POST['id'];

$con=$_POST['con'];
$fol=$_POST['fol'];
$xray=$_POST['xray'];
$dr=$_POST['dr'];
$str=$_POST['str'];
$ecg=$_POST['ecg'];


$sql="update opdbill set consultation='".$con."',follow_up='".$fol."',xray='".$xray."',dressing ='".$dr."',strapping ='".$str."',ecg ='".$ecg."' ";

$result=mysqli_query($con,$sql);
if($result)
{

header("location: home.php");

}
else
echo "error Inserting data";
?>