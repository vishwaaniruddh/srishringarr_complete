<?php
include('config.php');

//$title=$_POST['title'];
//$message=$_POST['message'];
$aid=$_POST['macAddress'];  //'hhhh';//
$lat=$_POST['latitude'];    //'45.00';//
$lon=$_POST['longitude'];   //'23.29';//
$add=$_POST['address'];     //'bhilai';//
$t=date('Y-m-d H:i:s');
$result = mysqli_query($conn,"insert into note_test_location(latitude,longitude,address,dtime,macid) values('".$lat."','".$lon."','".$add."','".$t."','".$aid."')");

?>