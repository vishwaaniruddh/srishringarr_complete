<?php
include_once('config.php');
$hiddenid=$_POST['hiddenid'];
//=============on clicking on deactivate button it will deactivate site =====================
$update="UPDATE Amc SET active='N' WHERE amcid='$hiddenid'";
$result=mysqli_query($con1,$update);
header("Content-type:application/json");
echo json_encode($result);

?>