<?php
include("config.php");
$assets=$_POST['ass_name'];
//echo "insert into assets(assets_name) values('$assets')";
$qry=mysqli_query($con1,"insert into assets(assets_name) values('$assets')");
if($qry){
header('location:NewAssets.php');
}else{

echo "error updating data".mysqli_error();
}
?>