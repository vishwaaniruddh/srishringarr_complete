<?php 
include("config.php");
$city=$_GET['city'];

$qry=mysqli_query($con1,"SELECT * FROM  `branch_head` where city='$city' ");
$num=mysqli_num_rows($qry);
echo $num;
?>