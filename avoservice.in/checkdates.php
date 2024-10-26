<?php
 session_start();
include 'config.php';
include("access.php");
$date=$_POST['dates'];
$dates=date("Y-m-d", strtotime($date) );


$sql="select date from Attendance where date ='".$dates."' and branch='".$_SESSION['branch']."'";
//$sql="select date from Attendance where date ='".$dates."'";
$result=mysqli_query($con1,$sql);
//echo $sql;

$numrow=mysqli_num_rows($result);

//echo $numrow;

if($numrow > 0){
echo "1";
}
else{
echo "0";
}
?>