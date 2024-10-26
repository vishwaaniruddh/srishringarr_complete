<?php
 session_start();
include 'config.php';
include("access.php");

$date=$_POST['dates'];
$branch=$_POST['br'];
$dept=$_POST['dept1'];

//$date='10/04/2022';
//$branch='Andhra Pradesh';
//$dept='Service';

$dates=date("Y-m-d", strtotime($date) );

$sql="select date from Attendance where date ='".$dates."' and branch='".$branch."'";

if(isset($_POST['dept1']) && $_POST['dept1'] =='service') {

$sql.=" and department='Service'";
} 
if(isset($_POST['dept1']) && $_POST['dept1'] =='other') {

$sql.=" and department !='Service'";
}
$result=mysqli_query($con1,$sql);
//echo $sql;

$numrow=mysqli_num_rows($result);

if($numrow > 0){

echo "1";
}
else{
echo "0";
}
?>