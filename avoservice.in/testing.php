<?php
 session_start();
include 'config.php';
include("access.php");
$data=array();
$abc="select * from Attendance where 1=1" ; 
$result=mysqli_query($con1,$abc);
while($row=mysqli_fetch($abc)){
$data[]=['id'=>$row['id']];

}
echo json_encode($data);
?>