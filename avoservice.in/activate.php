<?php
include_once('config.php');
$hiddenid=$_POST['hiddenid'];
//=============on clicking on activate button it will activate site =====================
$update="UPDATE Amc SET active='Y' WHERE amcid='$hiddenid'";
$result=mysqli_query($con1,$update);
header("Content-type:application/json");
echo json_encode($result);

?>