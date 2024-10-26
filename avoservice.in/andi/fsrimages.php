<?php
include("../config.php");
 if(isset($_POST['ImageName']))
 {
  $imgname=$_POST['ImageName'];
  $imgsrc=base64_decode($_POST['base64']);
  $picid=$_POST['pid'];
  $fp=fopen('fsrimages/'.$imgname,'w');
  fwrite($fp,$imgsrc);
  $type=substr($imgname,0,1);
  
  mysql_query("insert into fsr_images(alertid,signature,sign_type) values('".$picid."','".$imgname."','".$type."')");
 }
 
 ?>